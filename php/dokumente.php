<?php

require_once ('Database.php');
require_once('../libs/Smarty/lib/smarty/Smarty.class.php');
require_once ('../vendor/autoload.php');

$smarty = new Smarty();
$database = new Database();
$db       = $database->getDB();
$conn  = $db;

// Firmenadresse
$companyAddress     = "
                        SELECT plz, stadt, strasse 
                        FROM adressen 
                        WHERE adresse_id = '1'
                        ";
$sql                = $conn->prepare($companyAddress);
$sql->execute(array());
$company_address    = $sql->fetch(PDO::FETCH_ASSOC);

// Kundenadresse
$customeraddress = "
                    SELECT vorname, nachname, strasse, plz, stadt 
                    FROM kundenadressen 
                        LEFT JOIN nutzer 
                            ON kundenadressen.kundennr = nutzer.id 
                        LEFT JOIN adressen 
                            ON kundenadressen.adressen_id = adressen.adresse_id 
                    WHERE kundenadressen.adressen_id = '31'";
$sql             = $conn->prepare($customeraddress);
$sql->execute(array());
$customerAddress = $sql->fetch(PDO::FETCH_ASSOC);

// Kundennummer & Bestelldatum
$orderdetails = "
                SELECT bestell_datum, nutzer.id 
                FROM bestellungen 
                    LEFT JOIN nutzer 
                        ON bestellungen.kunden_nr = nutzer.id 
                WHERE bestellungen.id = '20'";
$sql          = $conn->prepare($orderdetails);
$sql->execute(array());
$orderDetails = $sql->fetch(PDO::FETCH_ASSOC);

// Rechnungsnummer
$invoiceSql = "
                SELECT rechnungsnummer 
                FROM bestellinfo 
                WHERE bestellungennr = '20'";
$sql = $conn->prepare($invoiceSql);
$sql->execute(array());
$invoice = $sql->fetch(PDO::FETCH_ASSOC);

// Auftragsnummer
$orderSql = "
                SELECT auftragsnummer
                FROM bestellungen 
                WHERE id = '20'";
$sql = $conn->prepare($orderSql);
$sql->execute(array());
$orderNumber = $sql->fetch(PDO::FETCH_ASSOC);

// Sachbearbeiter
$clerkDetails = "
                SELECT vorname, nachname, email 
                FROM nutzer 
                WHERE id = '12'";
$sql = $conn->prepare($clerkDetails);
$sql->execute(array());
$clerk = $sql->fetch(PDO::FETCH_ASSOC);

// Artikelpositionen
$articlePositions   = "
                    SELECT 
                           artikelnr, 
                           artikelname, 
                           artikelbez, 
                           preis, 
                           menge, 
                           mws, 
                           rabatt_bestelldetails,
                           round((preis * menge - (((preis * menge) / 100) * rabatt_bestelldetails)), 2) AS Gesamtpreis
                    FROM bestelldetails 
                        LEFT JOIN artikel 
                            ON bestelldetails.artikel_nr = artikel.artikelnr 
                    WHERE bestell_nr = '20'";
$sql                = $conn->prepare($articlePositions);
$sql->execute(array());
$positions          = $sql->fetchAll(PDO::FETCH_ASSOC);

// Rechnungsbetrag ermitteln
foreach($positions as $preis) {
    $nettowerte[] = $preis['Gesamtpreis'];
}
$nettowert = array_sum($nettowerte);

$mwst = round($nettowert / 100 * 19, 2);

$rechnungsbetrag = $nettowert + $mwst;


// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$smarty = new Smarty();
$smarty->assign("address", $company_address);
$smarty->assign("kundennummer", $orderDetails);
$smarty->assign("kundenadresse", $customerAddress);
$smarty->assign("sachbearbeiter", $clerk);
$smarty->assign("rechnungsnummer", $invoice);
$smarty->assign("auftragsnummer", $orderNumber);
$smarty->assign("positionen", $positions);
$smarty->assign("nettowert", $nettowert);
$smarty->assign("mwst", $mwst);
$smarty->assign("rechnungsbetrag", $rechnungsbetrag);
$smarty->assign("datum", date('d.m.y'));
$html = $smarty->fetch("../dokumente/rechnung.html");


// instantiate and use the dompdf class
$dompdf = new Dompdf();
$options = new Options();
$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');


// Render the HTML as PDF
$dompdf->render( );


// Output the generated PDF to Browser
$dompdf->stream('file', array("Attachment" => false));

