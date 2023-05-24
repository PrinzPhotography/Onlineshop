<?php
require_once ('database.php');
require_once ('login_registration.php');
require_once ('Database.php');
$database = new Database();
$db = $database->getDB();
session_start();
if($_POST['DATA'] == 'bewertung_abgeben') {
    $bewertung     = $_POST['bewertung'];
    $artikelnummer = $_POST['artikel'];
    $nutzer        = $_SESSION['id'];
    $sterne        = $_POST['sterne'];
    $conn          = getDB();
    if(!empty($nutzer)) {
        $sql  = "SELECT * FROM nutzer WHERE id = :nutzer";
        $stmt = $conn->prepare($sql);
        $data = [
            ':nutzer' => $nutzer
        ];
        $stmt->execute($data);
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        if($fetch['rolle'] != 'admin') {
            if(empty($bewertung)) {
                $bewertung = null;
            }
            $sql = "SELECT * 
                FROM bewertungen 
                WHERE nutzer_id = :userId AND artikel_nr = :articleId";
            $stmt = $db->prepare($sql);
            $data = [
                ':userId'    => $nutzer,
                ':articleId' => $artikelnummer
            ];
            $stmt->execute($data);
            $rating = $stmt->fetch(PDO::FETCH_ASSOC);

            if(empty($rating)) {
                $sql = "INSERT INTO bewertungen (sterne,rezension,artikel_nr,nutzer_id)
                    VALUES (?,?,?,?)";

                $statement = $conn->prepare($sql);
                $statement->execute(array($sterne, $bewertung, $artikelnummer, $nutzer));

                echo(json_encode(['success' => true]));
            } else {
                if(is_null($rating['rezension'])) {
                    $sql = "UPDATE bewertungen SET sterne = :stars, rezension = :rating WHERE id = :ratingId AND nutzer_id = :userId ";
                    $stmt = $db->prepare($sql);
                    $data = [
                        ':stars'    => $sterne,
                        ':rating'   => $bewertung,
                        ':ratingId' => $rating['id'],
                        ':userId'   => $rating['nutzer_id']
                    ];
                    $stmt->execute($data);
                    echo (json_encode(['success' => true, 'otherData' => 'Erfolgreich']));
                } else {
                    echo json_encode(['success' => true, 'otherData' => 'Update']);
                }
                //echo json_encode('Sie können einen Artikle nur eine Bewertung geben!');
            }

        } else {
            echo (json_encode(['success' => false]));
        }

    }
}
if ($_POST['DATA'] == 'bewertung_update') {

    $sql = "SELECT * 
            FROM bewertungen 
            WHERE nutzer_id = :userId AND artikel_nr = :articleId";
    $stmt = $db->prepare($sql);
    $data = [
        ':userId'    => $_SESSION['id'],
        ':articleId' => $_POST['article']
    ];
    $stmt->execute($data);
    $rating = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "UPDATE bewertungen SET sterne = :stars, rezension = :rating WHERE id = :ratingId AND nutzer_id = :userId ";
    $stmt = $db->prepare($sql);
    $data = [
        ':stars'    => $_POST['stars'],
        ':rating'   => $_POST['rating'],
        ':ratingId' => $rating['id'],
        ':userId'   => $rating['nutzer_id']
    ];
    $stmt->execute($data);
    echo (json_encode(['success' => true]));
}

