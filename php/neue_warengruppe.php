<?php
require_once('Database.php');
$database   = new Database();
$db         = $database->getDB();
$conn       = $db;

$category   = $_POST['warengruppe'];
$mwst       = $_POST['mwst'];
$rabatt     = $_POST['rabatt'];

$allInfo = [
    $category,
    $mwst,
    $rabatt
];

$arrayLength = count($allInfo);
$empty = false;
for($i = 0; $i < $arrayLength; $i++) {
    if(empty($allInfo[$i])) {
        $empty = true;
    }
}

$sql = "SELECT
            warengruppe
        FROM
            warengruppen
        WHERE
            warengruppe = :wg";
$stmt = $conn->prepare($sql);
$data = [
    ':wg' => $category
];
$stmt->execute($data);
$row = (bool)$stmt->rowCount();

if($empty) {
    echo (json_encode(['success' => false, 'reason' => 'empty']));
}

if($row) {
    echo (json_encode(['success' => false, 'reason' => 'exists']));
}

if(!$empty && !$row) {
    $sql = "INSERT INTO warengruppen (warengruppe,mehrwertsteuer,rabatte_id)
            VALUES (?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->execute(array($category,$mwst,$rabatt));
    echo (json_encode(['success' => true]));
}

