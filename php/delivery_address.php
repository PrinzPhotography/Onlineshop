<?php
#In Klasse umwandeln für bessere Umsetzung der database connection
require_once('Database.php');
require_once('Orders.php');
require_once ('User.php');
session_start();
$database = new Database();
$order = new Orders();
$user = new User();
$db       = $database->getDB();
$conn  = $db;
switch ($_POST['requirement']) {
    case 'SETADDRESS':
        $stmt = $conn->prepare("INSERT INTO
                                            adressen (plz, stadt, strasse, telefon) 
                                      VALUES
                                             (
                                              :plz, :std, :str, :tele
                                              )");
        $stmt->bindParam(':plz', $_POST['zipCode']);
        $stmt->bindParam(':std', $_POST['city']);
        $stmt->bindParam(':str', $_POST['street']);
        $stmt->bindParam(':tele', $_POST['phonenbr']);
        $stmt->execute();
        $last_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO
                                            kundenadressen (adressen_id, kundennr)
                                      VALUES
                                            (
                                            :ad_id, :kdnr
                                                )");
        $stmt->bindParam(':ad_id', $last_id);
        $stmt->bindParam(':kdnr', $_SESSION['id']);
        $stmt->execute();
        echo json_encode(['success' => true]);
        break;

    case 'CHECK':

        if($order->checkDeliveryAddress($_POST['address_id'])) {
            $_SESSION['address_id'] = $_POST['address_id'];
            echo (json_encode('1')); // nichts wurde an der adresse_id verändert
        }
        break;

    case 'EDIT':
        $order->updateDeliveryAddress();
        unset($_SESSION['address_id']);
        echo (json_encode('1'));
        break;

    case 'FAVORIT':
        if($order->checkDeliveryAddress($_POST['adresse'])) {
            $sql = "UPDATE kundenadressen
                    SET favorit = :favorit
                    WHERE favorit = :fav
                      AND kundennr = :session_id";
            $stmt = $conn->prepare($sql);
            $data = [
                ':favorit'    => NULL,
                ':fav'    => 'favorit',
                ':session_id' => $_SESSION['id']
            ];
            $stmt->execute($data);

            $sql = "UPDATE kundenadressen 
                    SET favorit = :favorit 
                    WHERE adressen_id = :adress 
                      AND kundennr = :session_id";
            $stmt = $conn->prepare($sql);
            $data = [
                ':favorit'    => 'favorit',
                ':adress'    => $_POST['adresse'],
                ':session_id' => $_SESSION['id']
            ];
            $stmt->execute($data);
            $_SESSION['favAdr'] = $_POST['adresse'];
            echo (json_encode(['success' => true]));
        } else {
            echo (json_encode(['success' => false]));
        }
        break;
    case 'DELETE':

        if($order->checkDeliveryAddress($_POST['toBeDeleted'])) {

            $order->delteDeliveryAddress($_POST['toBeDeleted']);
            unset($_SESSION['address_id']);
            echo (json_encode('1'));

        } else {

            echo (json_encode('0'));
        }
        break;

    case 'IS_LOGGED_IN':
        if(!is_null($_SESSION['id'])) { // Wenn User eingeloggt ist dann!
            $feedback = $order->checkOrder($_SESSION['id']);
            if(empty($feedback)) {
                echo (json_encode(['success' => true, 'feedback' => false]));
            } else {
                echo (json_encode(['success' => true, 'feedback' => $feedback]));
            }

        } else {
            echo (json_encode(['success' => false]));
        }
        break;
}

