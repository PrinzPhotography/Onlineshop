<?php

require_once('../libs/Smarty/lib/smarty/Smarty.class.php');
require_once ('../vendor/autoload.php');
require_once ('Database.php');

use Dompdf\Dompdf;

$database = new Database();
$db = $database->getDB();
$smarty = new Smarty();

$sql = "SELECT
            email,
            vorname,
            nachname
        FROM
            nutzer
        WHERE
            id = :id";
$stmt = $db->prepare($sql);
$stmt->execute([':id' => 11]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT
            *
        FROM
            bestellungen
        WHERE
            kunden_nr  = :id";
$stmt = $db->prepare($sql);
$stmt->execute(array(':id' => 11));
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
$array = [];
$i = 0;

foreach($orders as $order) {
    $id = $order['id'];
    $sql = "SELECT
            *
            FROM
                bestelldetails
            WHERE
                bestell_nr  = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':id' => $id));
    $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $artikelArray = [];

    $sql = "SELECT
            *
            FROM
                bestellinfo
            WHERE
                bestellungennr  = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':id' => $id));
    $info = $stmt->fetch(PDO::FETCH_ASSOC);

    $array[] = [
        'Bestell-Nr'   => $id,
        'Kunden-Nr'    => 11,
        'Vorname'      => $user['vorname'],
        'Nachname'     => $user['nachname'],
        'Plz'          => $info['plz'],
        'Stadt'        => $info['stadt'],
        'Strasse'      => $info['strasse'],
        'Telefon'      => $info['telefon'],
        'Email'        => $user['email'],
        'Bestelldatum' => $order['bestell_datum'],
        'Status'       => $order['status'],
    ];
    $c = 1;
    $orderCompletePrice = 0;
    $orderMwstPrice19   = 0;
    $orderMwstPrice7    = 0;
    $MwstTotal          = 0;
    foreach($details as $detail) {
        $pg  = $detail['preis_stueck'] * $detail['menge'];
        $RbG = (($detail['rabatt_bestelldetails'] / 100) * $detail['preis_stueck']) * $detail['menge'];
        $orderCompletePrice = $orderCompletePrice + ($pg - $RbG);
        if($detail['mws'] == 7) {
            $Mwst = (($detail['mws'] / 100) * $pg);
            $orderMwstPrice = $orderMwstPrice7 + $Mwst;
        }
        if($detail['mws'] == 19) {

            $Mwst = (($detail['mws'] / 100) * $pg);
            $orderMwstPrice19 = $orderMwstPrice19 + $Mwst;
        }
        $MwstTotal = $orderMwstPrice7 + $orderMwstPrice19;

        $sql = "SELECT
                    artikelname,
                    artikelbez
                FROM
                    artikel
                WHERE
                    artikelnr = :nr";
        $stmt = $db->prepare($sql);
        $stmt->execute([':nr' => $detail['artikel_nr']]);
        $art = $stmt->fetch(PDO::FETCH_ASSOC);

        $array[$i]['Artikel'][] = [
            'Position'     => $c,
            'Artikel-Nr'   => $detail['artikel_nr'],
            'Artikel-Name' => $art['artikelname'],
            'Artikel-Bez'  => $art['artikelbez'],
            'Menge'        => $detail['menge'],
            'PE'           => $detail['preis_stueck'],
            'PG'           => $pg,
            'Mwst'         => $detail['mws'],
            'Rabatt'       => $detail['rabatt_bestelldetails'],
            'RbG'          => $RbG
        ];
        $array[$i]['Nettopreis']  = $orderCompletePrice;
        $array[$i]['Mwst-Zusatz'] = $MwstTotal;
        $array[$i]['Mwsts']       = [
            7          => $orderMwstPrice7,
            19         => $orderMwstPrice19
        ];
        $c++;
    }

    $i++;
}
/*echo '<pre>';
var_dump($array);*/


$smarty->assign('info', $array[0]);
$html = $smarty->fetch('../templates/pdf.tpl');

// instantiate and use the dompdf class

$dompdf = new Dompdf();

$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

/*$filename = 'test.pdf';
$temp_doc_path = "C:/var/www/azubi-shop/dokumente_temp/{$filename}";
file_put_contents($temp_doc_path, $dompdf->output());*/
// Output the generated PDF to Browser

$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));



