<?php

class Orders
{
    private $db;
    function __construct() {
        require_once ('Database.php');
        $dbConnection = new Database();
        $this->db = $dbConnection->getDB();
    }
    function checkIfOrderIdIsTrue($orderId) {
        $check = false;

        $sql = "SELECT
                    * 
                FROM
                    bestellungen
                WHERE
                    id = :orderId";

        $stmt = $this->db->prepare($sql);
        $data = [
            ':orderId' => $orderId
        ];
        $stmt->execute($data);
        $orderStatus = $stmt->fetch(PDO::FETCH_ASSOC);
        if($orderStatus) {
            $this->changeOrderStatus($orderStatus, $orderId);
            $check = true;
        }

        return $check;
    }
    function changeOrderStatus($orderStatus, $orderId) {

        $sql = "UPDATE
                    bestellungen
                SET
                    status = :newStatus
                WHERE
                    id     = :orderId";

        $stmt = $this->db->prepare($sql);
        $data = 0;
        switch ($orderStatus['status']) {
            case 'neu':
                $data = [
                    ':newStatus' => 'bestätigt',
                    ':orderId'   => $orderId
                ];
                break;
            case 'bestätigt':
                $data = [
                    ':newStatus' => 'Lieferbereit',
                    ':orderId'   => $orderId
                ];
                break;
        }
        $stmt->execute($data);
        $this->checkInventoryOut();
        return true;
    }
    function checkInventoryOut() {
        $sql = "SELECT
                    id
                FROM
                    bestellungen
                WHERE
                    status = :status";
        $stmt = $this->db->prepare($sql);
        $data = [
            ':status' => 'Lieferbereit'
        ];
        $stmt->execute($data);
        $bestell_nr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($bestell_nr)) {

            foreach ($bestell_nr as $nr) {

                $sql = "SELECT
                        artikel,
                        menge
                    FROM
                        reservierung
                    WHERE
                        bestellnr = :bestellnr";
                $stmt = $this->db->prepare($sql);
                $data = [
                    ':bestellnr' => $nr['id']
                ];
                $stmt->execute($data);
                $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($info as $artQuant) {

                    $sql =  "SELECT
                            lagerbestand
                         FROM
                            artikel
                         WHERE
                            artikelnr = :art";
                    $stmt = $this->db->prepare($sql);
                    $data = [
                        ':art'   => $artQuant['artikel']
                    ];
                    $stmt->execute($data);
                    $lagerbestand = $stmt->fetch(PDO::FETCH_ASSOC)['lagerbestand'];

                    $sql =  "UPDATE
                            artikel
                         SET
                            lagerbestand = :quant
                         WHERE
                            artikelnr = :art";
                    $stmt = $this->db->prepare($sql);
                    $quant = $lagerbestand - $artQuant['menge'];
                    $data = [
                        ':quant' => $quant,
                        ':art'   => $artQuant['artikel']
                    ];
                    $stmt->execute($data);

                }
                $sql = "DELETE FROM
                        reservierung
                    WHERE
                        bestellnr = :orderId";
                $stmt = $this->db->prepare($sql);
                $data = [
                    ':orderId' => $nr['id']
                ];
                $stmt->execute($data);
            }
        }


        return true;
    }
    function createOrders($userId) {
        $feedback = $this->checkOrder($userId);
        if(empty($feedback)) {

            $cartItem = $this->getPrice($userId);
            if(!empty($cartItem)) {

                $this->createOrdersInstruction($userId, $cartItem);

            } else {
                return false;
            }

        }
        return $feedback;

    }

    function getPrice( $userId) {
        $sql = "SELECT
                    artikel_id,
                    anzahl,
                    preis,
                    Mwst
                FROM
                    warenkorb
                LEFT JOIN
                    artikel
                ON(
                    warenkorb.artikel_id = artikel.artikelnr
                    )
                LEFT JOIN
                    warengruppen
                ON(
                    warengruppe_id = warengruppen.id
                    )
                LEFT JOIN
                    mehrwertsteuer
                ON(
                    mehrwertsteuer = Mwst_id
                    )
                WHERE
                    nutzer_id = :userId";

        $stmt = $this->db->prepare($sql);
        $data = [
            ':userId' => $userId
        ];
        $stmt->execute($data);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function checkOrder($userId) {
        $items = $this->getPrice($userId);
        $feedback = [];
        foreach ($items as $article) {

            $sql = "SELECT
                        SUM(menge) AS total,
                        lagerbestand
                    FROM
                        reservierung
                    LEFT JOIN
                        artikel
                    ON (
                        artikel = artikelnr
                        )
                    WHERE
                        artikel = :artikelId";

            $stmt = $this->db->prepare($sql);
            $data = [
                ':artikelId' => $article['artikel_id']
            ];
            $stmt->execute($data);
            $sum = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!is_null($sum['lagerbestand']) && !is_null($sum['total']) ) {
                if( (($sum['lagerbestand'] - $sum['total']) - $article['anzahl']) < 0) {
                    $available = $sum['lagerbestand'] - $sum['total'];
                    $inputFeedback = ['artikel' => $article['artikel_id'],'erhaeltlich' => $available,'bestellt' => $article['anzahl']];
                    $back = ['text' => 'Artikel: '.$article['artikel_id'].' hat nur noch '.$available.' Einheiten verfuegbar. Sie wollen '.$article['anzahl'].' bestellen!'."\r\n"];
                    $feedback[] = $back;
                    //echo 'Du kannst diesen Artikel nicht Bestellen, da unser LAgerbestand dafür nicht ausreicht'."\r\n";
                }
            }
        }
        return $feedback;
    }

    function createOrdersInstruction ( $userId, $cartItem, $status = 'neu') {

        // Auftragsnummer generieren
        $auftragNr = "SELECT 
                            auftragsnummer 
                        FROM 
                            bestellungen";
        $sql = $this->db->prepare($auftragNr);
        $sql->execute(array());
        $auftrag[] = $sql->fetchAll(PDO::FETCH_ASSOC);

        $zeichen = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $auftragsnummer = substr(str_shuffle($zeichen),0, 10);

        while(in_array($auftragsnummer, $auftrag)) {

            $auftragsnummer = substr(str_shuffle($zeichen),0, 10);

        }

        $sql = 'INSERT INTO
                    bestellungen
                SET
<<<<<<< HEAD
                    status          = :status,
                    kunden_nr       = :userId,
                    auftragsnummer  = :auftragsnummer';

        $stmt = $this->db->prepare($sql);
        $data = [
            ':status'           => $status,
            ':userId'           => $userId,
            ':auftragsnummer'   => $auftragsnummer
=======
                    status        = :status,
                    kunden_nr     = :userId';

        $stmt = $this->db->prepare($sql);
        $data = [
            ':status' => $status,
            ':userId' => $userId,
>>>>>>> origin/77-dompdf
        ];
        $stmt->execute($data);
        $orderId = $this->db->lastInsertId();
        $this->discount($userId, $orderId);

        if( $this->checkCartItemsInOrder($userId, $cartItem, $orderId) ) {

            //Delete Warenkorb where nutzer_id === $userId

            $sql = "DELETE FROM
                        warenkorb
                    WHERE
                        nutzer_id = :userId";

            $stmt = $this->db->prepare($sql);
            $data = [
                ':userId' => $userId
            ];
            $stmt->execute($data);
        } else {
            //Do something else
            return false;
        }
    }

    function checkCartItemsInOrder($userId, $cartItems, $orderId) {
        $inOrders = false;

        foreach ($cartItems as $cartItem) {

            $sql = "SELECT
                        kunden_nr,
                        artikel_nr,
                        menge
                    FROM
                        bestelldetails
                    LEFT JOIN
                        bestellungen
                    ON(
                        bestelldetails.bestell_nr = bestellungen.id
                        )
                    WHERE
                        kunden_nr  = :userId
                    AND artikel_nr = :article
                    AND menge      = :quantity";

            $stmt = $this->db->prepare($sql);
            $data = [
              ':userId'   => $userId,
              ':article'  => $cartItem['artikel_id'],
              ':quantity' => $cartItem['anzahl']
            ];
            $stmt->execute($data);

            if($stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $inOrders = true;
            } else {
                $inOrders = false;
            }
        }
        return $inOrders;
    }
    function getUserOrders($userId) {

        $sql = "SELECT
                    *
                FROM
                    bestellungen 
                WHERE
                    kunden_nr = :userId
                ORDER BY
                    bestell_datum
                DESC";

        $stmt = $this->db->prepare($sql);
        $data = [
            ':userId' => $userId
        ];
        $stmt->execute($data);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserOrderHistory($userId) {
        $orderDetails = $this->getUserOrders($userId);
        $userOrders = [];
        foreach ($orderDetails as $orderDetail) {
            $articles = [];

            $sql = "SELECT
                        *
                    FROM
                        bestelldetails
                    LEFT JOIN
                        artikel
                    ON(
                        artikel_nr = artikelnr
                        ) 
                    WHERE
                        bestell_nr = :orderId";

            $stmt = $this->db->prepare($sql);
            $data = [
                ':orderId' => $orderDetail['id']
            ];
            $stmt->execute($data);
            $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($details as $detail) {
                $total = 0;
                $quantity                = $detail['menge'];
                $price                   = $detail['preis_stueck'];
                $mws                     = $detail['mws'];
                $rabatt                  = $detail['rabatt_bestelldetails'];
                $priceR                  = ($price - ($price * ($rabatt / 100))) * $quantity ;
                $priceInklMws            = $priceR + ($priceR * ($mws / 100));
                $total                   = $total + $priceInklMws;
                $detail['total']         = $total;
                $detail['discountPrice'] = $priceR;
                $articles[]              = $detail;
            }
            $userOrders[] = $articles;
        }
        return $userOrders;

    }
    function getTotalPrice($userId) {
        $orderDetails    = $this->getUserOrders($userId);
        $userTotalPrices = [];

        foreach ($orderDetails as $details) {

            $sql = "SELECT
                        bestell_datum,
                        status,
                        kunden_nr,
                        artikel_nr,
                        menge,
                        preis_stueck,
                        bestell_nr,
                        mws,
                        rabatt_bestelldetails
                    FROM
                        bestellungen
                    LEFT JOIN
                        bestelldetails
                    ON(
                        bestellungen.id = bestelldetails.bestell_nr
                        )
                    WHERE
                        bestellungen.id = :orderId";
            $stmt = $this->db->prepare($sql);
            $data = [
                ':orderId' => $details['id']
            ];
            $stmt->execute($data);
            $all   = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $total = 0;

            foreach ($all as $info) {

                $quantity     = $info['menge'];
                $price        = $info['preis_stueck'];
                $mws          = $info['mws'];
                $rabatt       = $info['rabatt_bestelldetails'];
                $priceR       = ($price - ($price * ($rabatt / 100))) * $quantity ;
                $priceInklMws = $priceR + ($priceR * ($mws / 100));
                $total        = $total + $priceInklMws;

            }

            $orderId                   = $all[0]['bestell_nr'];
            $userTotalPrices[$orderId] = ['key' => $orderId, 'total' => $total];

        }

        return $userTotalPrices;
    }

    ##### ------------------------------------ All Order Information ---------------------------------------------------- #####

    function getAllOrders($status) {

        $sql = "SELECT
                    *
                FROM
                    bestellungen
                WHERE
                    status = :status
                ORDER BY
                    bestell_datum
                DESC";

        $stmt = $this->db->prepare($sql);
        $data = [
            ':status' => $status
        ];
        $stmt->execute($data);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getAllOrderHistorys($status) {
        $orderDetails = $this->getAllOrders($status);
        $userOrders   = [];
        foreach ($orderDetails as $orderDetail) {
            $articles = [];

            $sql = "SELECT
                        *
                    FROM
                        bestelldetails
                    LEFT JOIN
                        artikel
                    ON(
                        artikel_nr = artikelnr
                        ) 
                    WHERE
                        bestell_nr = :orderId";

            $stmt = $this->db->prepare($sql);
            $data = [
                ':orderId' => $orderDetail['id']
            ];
            $stmt->execute($data);
            $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($details as $detail) {
                $total = 0;
                $quantity                = $detail['menge'];
                $price                   = $detail['preis_stueck'];
                $mws                     = $detail['mws'];
                $rabatt                  = $detail['rabatt_bestelldetails'];
                $priceR                  = ($price - ($price * ($rabatt / 100))) * $quantity ;
                $priceInklMws            = $priceR + ($priceR * ($mws / 100));
                $total                   = $total + $priceInklMws;
                $detail['total']         = $total;
                $detail['discountPrice'] = $priceR;
                $articles[]              = $detail;

            }
            $userOrders[] = $articles;
        }
        return $userOrders;

    }
    function getAllOrderTotalPrices($status) {

        $orderDetails    = $this->getAllOrders($status);
        $userTotalPrices = [];
        foreach ($orderDetails as $details) {
            $sql = "SELECT
                        bestell_datum,
                        status,
                        kunden_nr,
                        artikel_nr,
                        menge,
                        preis_stueck,
                        bestell_nr,
                        mws,
                        rabatt_bestelldetails
                    FROM
                        bestellungen
                    LEFT JOIN
                        bestelldetails
                    ON(
                        bestellungen.id = bestelldetails.bestell_nr
                        )
                    WHERE
                        bestellungen.id = :orderId";
            $stmt = $this->db->prepare($sql);
            $data = [
                ':orderId' => $details['id']
            ];
            $stmt->execute($data);
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $total = 0;
            foreach ($all as $info) {

                $quantity     = $info['menge'];
                $price        = $info['preis_stueck'];
                $mws          = $info['mws'];
                $rabatt       = $info['rabatt_bestelldetails'];
                $priceR       = ($price - ($price * ($rabatt / 100))) * $quantity ;
                $priceInklMws = $priceR + ($priceR * ($mws / 100));
                $total        = $total + $priceInklMws;

            }

            $orderId                   = $all[0]['bestell_nr'];
            $userTotalPrices[$orderId] = ['key' => $orderId, 'total' => $total];

        }

        return $userTotalPrices;
    }


    ##### ------------------------------------- Discount Properties ----------------------------------------------- #####

    function getGroupDiscount($userId) {
        $sql ="SELECT
                   artikel_id,
                   anzahl,
                   preis,
                   Mwst,
                   rabatte.rabatt 
               FROM
                   warenkorb 
               LEFT JOIN
                   artikel 
               ON(
                   warenkorb.artikel_id = artikel.artikelnr
                   ) 
               LEFT JOIN
                   warengruppen 
               ON(
                   artikel.warengruppe_id = warengruppen.id
                   ) 
               LEFT JOIN
                   mehrwertsteuer 
               ON(
                   mehrwertsteuer = Mwst_id
                   ) 
               LEFT JOIN
                   rabatte 
               ON(
                   warengruppen.rabatte_id = rabatte.rab_id
                   ) 
               WHERE
                   nutzer_id = :userId";
        $stmt = $this->db->prepare($sql);
        $data = [
            ':userId' => $userId
        ];
        $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getArticleDiscount($userId) {

            $sql ="SELECT
                       artikel_id,
                       anzahl,
                       preis,
                       mehrwertsteuer,
                       rabatte.rabatt 
                   FROM
                       warenkorb 
                   LEFT JOIN
                       artikel 
                   ON(
                       warenkorb.artikel_id = artikel.artikelnr
                       ) 
                   LEFT JOIN
                       warengruppen 
                   ON(
                       artikel.warengruppe_id = warengruppen.id
                       ) 
                   LEFT JOIN
                       mehrwertsteuer 
                   ON(
                       mehrwertsteuer = Mwst_id
                       ) 
                   LEFT JOIN
                       rabatte 
                   ON(
                       artikel.rabatt = rabatte.rab_id
                       ) 
                   WHERE
                       nutzer_id = :userId";
            $stmt = $this->db->prepare($sql);
            $data = [
                ':userId' => $userId
            ];
            $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    function discount($userId, $orderId) {
        $discountW = $this->getGroupDiscount($userId);
        $discountA = $this->getArticleDiscount($userId);

        $sql       = "SELECT
                          *
                      FROM
                          mengenrabatte
                      WHERE
                          zustand = :state";

        $stmt      = $this->db->prepare($sql);
        $data      = [
            ':state' => 'active'
        ];
        $stmt->execute($data);
        $rab = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($discountW as $warenG) {

            foreach ($discountA as $art) {

                if ($warenG['artikel_id'] == $art['artikel_id']) {

                    if ($warenG['rabatt'] >= $art['rabatt']) {

                        if ($rab['abnahme_menge'] >= $warenG['anzahl']) {

                            if ($rab['mengen_rabatt	'] >= $warenG['rabatt']) {
                                $this->insertIntoBestelldetails($warenG, $orderId, $rab['rabatt']);
                            } else {
                                $discount = $warenG['rabatt'];
                                $this->insertIntoBestelldetails($warenG, $orderId, $discount);
                            }
                        } else {
                            $discount = $warenG['rabatt'];
                            $this->insertIntoBestelldetails($warenG, $orderId, $discount);
                        }
                    } else {
                        if ($rab['abnahme_menge'] >= $art['anzahl']) {

                            if ($rab['mengen_rabatt	'] >= $art['rabatt']) {
                                $this->insertIntoBestelldetails($warenG, $orderId, $rab['rabatt']);
                            } else {
                                $discount = $art['rabatt'];
                                $this->insertIntoBestelldetails($warenG, $orderId, $discount);
                            }
                        } else {
                            $discount = $art['rabatt'];
                            $this->insertIntoBestelldetails($warenG, $orderId, $discount);
                        }
                    }

                }
            }
        }
        return 0;
    }

    function insertIntoBestelldetails($cartInfo, $orderId, $discount) {
        $sql = 'INSERT INTO
                    bestelldetails
                SET
                    artikel_nr            = :article_id,
                    menge                 = :quantity,
                    preis_stueck          = :price,
                    mws                   = :tax,
                    bestell_nr            = :orderId,
                    rabatt_bestelldetails = :discount';

        $stmt = $this->db->prepare($sql);
        $data = [
            ':article_id' => $cartInfo['artikel_id'],
            ':quantity'   => $cartInfo['anzahl'],
            ':price'      => $cartInfo['preis'],
            ':tax'        => $cartInfo['Mwst'],
            ':orderId'    => $orderId,
            ':discount'   => $discount
        ];
        $stmt->execute($data);

        $sql = "INSERT INTO
                    reservierung
                SET
                    bestellnr = :orderId,
                    artikel   = :artikelId,
                    menge     = :quantity";

        $stmt = $this->db->prepare($sql);
        $data = [
            ':orderId'   => $orderId,
            ':artikelId' => $cartInfo['artikel_id'],
            ':quantity'  => $cartInfo['anzahl']
        ];
        $stmt->execute($data);
        $this->insertIntoBestellinfo($orderId);
    }
    function getDeliveryAddressInfo() {
        $sql = "SELECT
                    plz,
                    stadt,
                    strasse,
                    telefon,
                    vorname,
                    nachname,
                    adresse_id,
                    favorit
                FROM
                    kundenadressen
                LEFT JOIN
                    adressen
                ON(
                    adressen_id = adresse_id 
                    )
                LEFT JOIN
                nutzer
                ON(
                    kundennr = id
                    )
                WHERE
                    kundennr = :session_id
                ORDER BY 
                    favorit IS NULL,
                    favorit DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':session_id', $_SESSION['id']);
        $stmt->execute();
        $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $addresses;
    }
    function deliv() {

        $stmt = $this->db->prepare("SELECT
                                              *
                                          FROM
                                              adressen
                                          WHERE
                                              adresse_id = :address_id");

        $stmt->bindParam(':address_id', $_SESSION['address_id']);
        $stmt->execute();
        $addres  = $stmt->fetch(PDO::FETCH_ASSOC);
        $address = [$addres];
        return $address;
    }
    function checkDeliveryAddress($address) {

        $stmt = $this->db->prepare("SELECT
                                              *
                                          FROM
                                              kundenadressen
                                          WHERE
                                              adressen_id = :address_id
                                          AND kundennr    = :user");

        $stmt->bindParam(':address_id', $address);
        $stmt->bindParam(':user', $_SESSION['id']);
        $stmt->execute();
        return (bool)$stmt->rowCount();
    }
    function delteDeliveryAddress($address) {

        $stmt = $this->db->prepare("DELETE
                                          FROM
                                                kundenadressen
                                          WHERE
                                                adressen_id = :address_id");

        $stmt->bindParam(':address_id', $address);
        $stmt->execute();
        $isValid = (bool)$stmt->rowCount();

        if($isValid === false) {

            $stmt = $this->db->prepare("DELETE
                                              FROM
                                                    adressen
                                              WHERE
                                                    adresse_id = :address_id");

            $stmt->bindParam(':address_id', $address);
            $stmt->execute();
        }

    }
    function updateDeliveryAddress() {

        $stmt = $this->db->prepare("UPDATE
                                              adressen
                                          SET 
                                              plz        = :plz,
                                              stadt      = :stadt,
                                              strasse    = :strasse,
                                              telefon    = :telefon
                                          WHERE
                                              adresse_id = :address
                                          AND kundennr   = :session_id");
        $stmt->bindParam(':plz', $_POST['zip']);
        $stmt->bindParam(':stadt', $_POST['city']);
        $stmt->bindParam(':strasse', $_POST['street']);
        $stmt->bindParam(':telefon', $_POST['phonenr']);
        $stmt->bindParam(':address', $_SESSION['address_id']);
        $stmt->execute();
    }
    ###############################################################


    function orderTransaction() {
        $sql = "SELECT
                    zahlungsart,
                    favorit
                FROM 
                    nutzer
                LEFT JOIN
                    kundenadressen
                ON(
                    nutzer.id = kundennr
                )
                WHERE
                    zahlungsart IS NOT NULL
                AND favorit IS NOT NULL 
                AND nutzer.id = :userId
                ";
        $stmt = $this->db->prepare($sql);
        $data = [
            ':userId' => $_SESSION['id']
        ];
        $stmt->execute($data);
        $check = (bool)$stmt->rowCount();
        $fehlermeldung = [
            'zahlungsart'   => false,
            'lieferadresse' => false
        ];
        if(!is_null($_SESSION['zahlung'])) {
            $fehlermeldung['zahlungsart'] = $_SESSION['zahlung'];
        }
        if(!is_null($_SESSION['favAdr'])) {
            $fehlermeldung['lieferadresse'] = $_SESSION['favAdr'];
        }
        return $fehlermeldung;
    }
    function getZahlungsarten() {

            $sql = "SELECT
                        *
                    FROM
                        zahlungsarten";

            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
    }
    function insertIntoBestellinfo($orderId){
        session_start();

        // Rechnungsnummer erstellen
        $rechnungsNr = "SELECT 
                            rechnungsnummer 
                        FROM 
                            bestellinfo";
        $sql = $this->db->prepare($rechnungsNr);
        $sql->execute(array());
        $rechnung[] = $sql->fetchAll(PDO::FETCH_ASSOC);

        $zeichen = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rechnungsnummer = substr(str_shuffle($zeichen),0, 10);

        while(in_array($rechnungsnummer, $rechnung)) {

            $rechnungsnummer = substr(str_shuffle($zeichen),0, 10);

        }

        $sql = "SELECT
                    *
                FROM
                    adressen
                WHERE
                    adresse_id = :adress";

        $stmt   = $this->db->prepare($sql);
        $stmt->execute([':adress' => $_SESSION['favAdr']]);
        $adress = $stmt->fetch(PDO::FETCH_ASSOC);
        $sql = "INSERT INTO
                    bestellinfo
                SET
                    bestellungennr      = :orderId,
                    zahlungsartid       = :zahlung,
                    plz                 = :plz,
                    stadt               = :stadt,
                    strasse             = :strasse,
                    telefon             = :telefon,
                    rechnungsnummer     = :rechnungsnummer";
        $stmt = $this->db->prepare($sql);
        $data = [
            ':orderId'          => $orderId,
            ':zahlung'          => $_SESSION['zahlung'],
            ':plz'              => $adress['plz'],
            ':stadt'            => $adress['stadt'],
            ':strasse'          => $adress['strasse'],
            ':telefon'          => $adress['telefon'],
            ':rechnungsnummer'  => $rechnungsnummer
        ];
        $stmt->execute($data);
    }
    function updateZahlung($zahlung) {
        session_start();
        $sql = "UPDATE
                    nutzer
                SET
                    zahlungsart = :zahlung
                WHERE
                    id          = :userId";
        $stmt = $this->db->prepare($sql);
        $data = [
            ':zahlung'   => $zahlung,
            ':userId'    => $_SESSION['id']
        ];
        $stmt->execute($data);
    }


}
