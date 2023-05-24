<?php
require_once ('Database.php');
require_once ('User.php');
require_once('Orders.php');
$database = new Database();
$db = $database->getDB();
$user = new User();
$order = new Orders();
try {
    $database->getDB();;
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
$firstname = '';
switch($_POST['requirement']) {

    case 'LOGIN':

        $stmt = $db->prepare("SELECT * 
                                        FROM nutzer 
                                        WHERE email = :email");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();
        $count = $stmt->rowCount();// ist die email vorhanden?
        if ($count == 1){
            //Username ist vorhanden
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($_POST['pw'], $row['password'])) { // Eingegebenes Passwort mit Passwort in der db vergleichen
                $user->setSession($row);
                echo(json_encode('1'));
            } else {
                echo(json_encode('01'));
            }
        } else {
            echo(json_encode('0'));
        }
        break;

    case 'REGISTRATION';
    $roll = 'nutzer';
        $stmt = $db->prepare("SELECT * 
                                        FROM nutzer
                                        WHERE email = :email");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0) { 
            //email ist frei
            if($_POST['pw1'] == $_POST['pw2']) {
                $id = rand(11111111,99999999);
                $stmt = getDB()->prepare("INSERT INTO nutzer (id, vorname, nachname, email, password, rolle)
                                                VALUES (:id, :firstname, :lastname, :email, :pw, :roll)");
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':firstname', $_POST['firstname']);
                $stmt->bindParam(':lastname', $_POST['lastname']);
                $stmt->bindParam(':email', $_POST['email']);
                $hash = password_hash($_POST['pw1'], PASSWORD_BCRYPT);
                $stmt->bindParam(':pw', $hash);
                $stmt->bindParam(':roll', $roll);
                $stmt->execute();
                echo (json_encode('1'));
            } else {
                echo (json_encode('01'));
                //Die Passwörter stimmen nicht überrein
            }
        } else {
            echo (json_encode('0'));
            //Die Email ist bereits vergeben
        }
        break;

}
