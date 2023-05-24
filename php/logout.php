<?php
require_once('Database.php');
$database = new Database();
$db = $database->getDB();
session_start();
function isLoggedIn():bool {
    if(isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}
function getFirstname($db){
    $stmt = $db->prepare("SELECT * 
                                    FROM nutzer 
                                    WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['vorname'];
}

if($_POST['requirement'] == 'LOGOUT') {
    session_destroy();
    echo(json_encode('1'));
}
