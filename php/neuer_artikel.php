<?php
//require_once('databaseOld.php');
require_once('Database.php');
$database   = new Database();
$db         = $database->getDB();
$conn       = $db;

$artikel_name       = $_POST['artikel_name'];
$artikel_bez        = $_POST['artikel_bez'];
$beschreibung       = $_POST['artikel_beschreibung'];
$hersteller         = $_POST['hersteller'];
$preis              = $_POST['preis'];
$lagerbestand       = $_POST['lagerbestand'];
$warengruppe        = $_POST['warengruppe'];
$image              = substr($_POST['image'], 12);
$date               = date('Y-m-d');
$rabatt             = $_POST['rabatt'];
$verfuegbarkeit     = $_POST['verfuegbarkeit'];

$allInformation = [
    $artikel_name,
    $artikel_bez,
    $beschreibung,
    $hersteller,
    $preis,
    $lagerbestand,
    $warengruppe,
    $image,
    $rabatt,
    $verfuegbarkeit
];
$arrayLenght = count($allInformation);
$emtpy = false;
for($i = 0; $i < $arrayLenght; $i++) {
    if(empty($allInformation[$i])) {
        $emtpy = true;
    }
}
if($emtpy) {
    echo (json_encode(['success' => false]));
} else {

    $sql = "SELECT
            artikelnr
        FROM
            artikel
        ORDER BY
            artikelnr
        DESC";
    $stmt = $db->query($sql);
    $artnr = (int)$stmt->fetch(PDO::FETCH_ASSOC)['artikelnr'];
    $artnr++;
    $sql = "INSERT INTO
                artikel
                (
                 artikelnr,
                 artikelname,
                 artikelbez,
                 artikelbeschreibung,
                 hersteller,
                 warengruppe_id,
                 preis,
                 rabatt,
                 lagerbestand,
                 produktbild,
                 verfuegbarkeit,
                 hinzugefuegt
                 ) 
            VALUES
               (?,?,?,?,?,?,?,?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->execute(array($artnr,$artikel_name,$artikel_bez,$beschreibung,$hersteller,$warengruppe,$preis,$rabatt,$lagerbestand,$image,$verfuegbarkeit,$date));


    echo (json_encode(['success' => true]));
}

