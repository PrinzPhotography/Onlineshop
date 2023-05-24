<?php
require_once('Database.php');
$database = new Database();
$db       = $database->getDB();
$conn  = $db;

switch($_POST['DATA']){

    case 'warengruppe_speichern':
        $warengruppe = $_POST['warengruppe'];
        $mwst = $_POST['mehrwertsteuer'];
        $rabatt = $_POST['rabatt'];
        $statement = $conn->prepare("UPDATE warengruppen
                                           SET mehrwertsteuer = ?, rabatte_id = ? 
                                           WHERE warengruppe  = ?");
        $statement->execute(array($mwst,$rabatt,$warengruppe));

        echo(json_encode(["success" => true]));
        break;
}
