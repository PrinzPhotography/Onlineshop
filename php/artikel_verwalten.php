<?php

require_once ('Database.php');
$database = new Database();
$db       = $database->getDB();
$conn  = $db;

switch ($_POST['DATA']){
    case 'bewertung_delete':
        deleteRezi($_POST['bewertungId'], $conn);
        echo (json_encode('1'));
        break;
/*    case 'artikelliste':
        $artikelSql = "SELECT * 
                        FROM artikel 
                        LEFT JOIN warengruppen 
                            on warengruppe_id = id  
                        ORDER BY artikelnr  ASC";
        $sql        = $conn->query($artikelSql);
        $artikel = $sql->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 'artikeldetails_bearbeiten':

        $articleNr  = $_POST['art_nr'];

        $artikelSql = "SELECT * 
                        FROM artikel 
                        LEFT JOIN warengruppen ON artikel.warengruppe_id  = warengruppen.id
                        LEFT JOIN rabatte ON artikel.rabatt = rabatte.rab_id
                        WHERE artikelnr  = ?";
        $sql        = $conn->prepare($artikelSql);
        $sql->execute(array($articleNr));
        echo(json_encode($artikel = $sql->fetch(PDO::FETCH_ASSOC)));
        break;*/
    case 'select_warengruppen':


        $warengrpSql = "SELECT * 
                        FROM warengruppen";
        $sql         = $conn->prepare($warengrpSql);
        $sql->execute(array());

        echo(json_encode($warengrp = $sql->fetchAll(PDO::FETCH_ASSOC)));
        break;

/*    case 'select_rabatt':


        $rabattSql  = "SELECT * 
                        FROM rabatte";
        $sql        = $conn->prepare($rabattSql);
        $sql->execute(array());

        echo(json_encode($rabatt = $sql->fetchAll(PDO::FETCH_ASSOC)));
        break;*/

    case 'select_mehrwertsteuer':


        $warengrpSql = "SELECT * 
                        FROM mehrwertsteuer";
        $sql         = $conn->prepare($warengrpSql);
        $sql->execute(array());

        echo(json_encode($mehrwertsteuer = $sql->fetchAll(PDO::FETCH_ASSOC)));
        break;

    case 'artikel_speichern':

        $artikel_nr         = $_POST['artikel_nr'];
        $artikel_name       = $_POST['artikel_name'];
        $artikel_bez        = $_POST['artikel_bez'];
        $beschreibung       = $_POST['artikelbeschreibung'];
        $hersteller         = $_POST['hersteller'];
        $preis              = $_POST['preis'];
        $rabatt             = $_POST['rabatt'];
        $lagerbestand       = $_POST['lagerbestand'];
        $warengruppe        = $_POST['warengruppe'];
        $image              = substr($_POST['image'], 12);
        $verfuegbarkeit     = $_POST['verfuegbarkeit'];

        $statement          = $conn->prepare("UPDATE artikel 
                                            LEFT JOIN warengruppen ON artikel.warengruppe_id = warengruppen.id 
                                            SET artikelname = ?,artikelbez = ?,artikelbeschreibung = ?,hersteller = ?,preis = ?,rabatt = ?,lagerbestand = ?,warengruppe_id = ?,produktbild = ?,verfuegbarkeit = ? 
                                            WHERE artikelnr  = ?");
        $statement->execute(array($artikel_name,$artikel_bez,$beschreibung,$hersteller,$preis,$rabatt,$lagerbestand,$warengruppe,$image,$verfuegbarkeit,$artikel_nr));

        echo(json_encode(["ok" => "Artikel erfolgreich bearbeitet"]));
        break;

    case ' Artikel':

        session_start();
        $_SESSION['suche'] = $_POST['suche'];

        echo (json_encode('1'));
        break;

    case 'artikelseite':

        session_start();
        $_SESSION['artikel'] = $_POST['artikel'];

        echo (json_encode('1'));
        break;

    case 'sucheArtikeledit':

        $suche      = '%'.$_POST['suche'].'%';

        $artikelSql = "SELECT artikelnr,artikelname,artikelbez,hersteller,preis,warengruppe,produktbild,lagerbestand,verfuegbarkeit 
                        FROM artikel 
                        LEFT JOIN warengruppen 
                            on warengruppe_id = id 
                        WHERE artikelname LIKE ? or artikelbez LIKE ? or hersteller LIKE ? or preis LIKE ? or warengruppe LIKE ? or verfuegbarkeit LIKE ?";
        $sql        = $conn->prepare($artikelSql);
        $sql->execute(array($suche,$suche,$suche,$suche,$suche,$suche));

        echo (json_encode($artikel = $sql->fetchAll(PDO::FETCH_ASSOC)));
        break;

    case 'bewertungen_index':


        $artikelSql = "SELECT artikelnr 
                    FROM artikel";

        $sql        = $conn->prepare($artikelSql);
        $sql->execute(array());

        echo (json_encode($artNr = $sql->fetchAll(PDO::FETCH_ASSOC)));
}



############################## getDB() muss noch ersetzt werden, functionen in Klasse umwandeln ?! #####################

function getProducts() {

    $stmt = getDB()->query("SELECT * 
                                        FROM artikel 
                                        LEFT JOIN warengruppen 
                                            on warengruppe_id = id  
                                        ORDER BY artikelnr  ASC");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function alleArtikel() {

    $conn       = getDB();

    $artikelSql = "SELECT * 
                    FROM artikel 
                    LEFT JOIN warengruppen 
                        on warengruppe_id = id  
                    ORDER BY artikelnr  ASC";
    $sql        = $conn->prepare($artikelSql);
    $sql->execute(array());

    return $sql->fetchAll(PDO::FETCH_ASSOC);
}


function suche($suche) {

    $conn       = getDB();
    $search     = '%'.$suche.'%';

    $artikelSql = "SELECT artikelname,artikelnr,artikelbez,hersteller,preis,warengruppe_id,produktbild,verfuegbarkeit 
                    FROM artikel 
                    LEFT JOIN warengruppen 
                        on warengruppe_id = id 
                    WHERE artikelname LIKE ? or artikelbez 
                    LIKE ? or hersteller LIKE ? or preis LIKE ? or warengruppe LIKE ?";
    $sql        = $conn->prepare($artikelSql);
    $sql->execute(array($search,$search,$search,$search,$search));
    $artikel    = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($artikel) {
        return $artikel;
    } else {
        return [];
    }

}


function artikelseite($artikelseite) {

    $artikelnummer  = $artikelseite;
    $conn           = getDB();

    $artikelSql     = "SELECT artikelnr,artikelname,artikelbez,artikelbeschreibung,hersteller,preis,warengruppe_id,produktbild,verfuegbarkeit 
                        FROM artikel 
                        LEFT JOIN warengruppen 
                            on warengruppe_id = id 
                        WHERE artikelnr = ?";
    $sql            = $conn->prepare($artikelSql);
    $sql->execute(array($artikelnummer));

    return $sql->fetchAll(PDO::FETCH_ASSOC);

}


function bewertungArtikel($artikelseite) {
    $artikelnummer = $artikelseite;
    $conn  = getDB();
    $artikelSql = "SELECT bewertungen.id,
                          nutzer.vorname,
                          bewertungen.sterne,
                          bewertungen.rezension
                    FROM bewertungen 
                        LEFT JOIN artikel on bewertungen.artikel_nr = artikel.artikelnr 
                        LEFT JOIN nutzer on bewertungen.nutzer_id = nutzer.id 
                    WHERE artikelnr = ?";
    $sql = $conn->prepare($artikelSql);
    $sql->execute(array($artikelnummer));
    $artikel = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $artikel;
}

function durchschnittsBewertung() {
    $conn       = getDB();

    $artikelSql = "SELECT artikelnr,sterne 
                    FROM artikel
                    LEFT JOIN bewertungen on artikel.artikelnr = bewertungen.artikel_nr";

    $sql        = $conn->prepare($artikelSql);
    $sql->execute(array());
    $artNr = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $artNr;

}
function deleteRezi($id, $conn) {
    $sql  = "DELETE FROM bewertungen WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $data = [
        ':id'      => $id
    ];
    $stmt->execute($data);
}

