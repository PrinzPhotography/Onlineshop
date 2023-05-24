<?php
class Article
{
    private $db;

    function __construct() {
        require_once ('Database.php');
        $dbConnection = new Database();
        $this->db = $dbConnection->getDB();
    }

    function getProducts() {

        $stmt = $this->db->query("SELECT * 
                                        FROM artikel 
                                        LEFT JOIN warengruppen 
                                            on warengruppe_id = id  
                                        ORDER BY artikelnr  ASC");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function alleArtikel($no_of_records_per_page, $offset) {
        $sql = "SELECT * FROM `artikel` ORDER BY artikel.hinzugefuegt DESC LIMIT :lim OFFSET :off";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':lim', $no_of_records_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
/*        $artikelSql = "SELECT *
                    FROM artikel 
                    LEFT JOIN warengruppen 
                        on warengruppe_id = id  
                    ORDER BY artikelnr  ASC";
        $sql        = $this->db->prepare($artikelSql);
        $sql->execute(array());

        return $sql->fetchAll(PDO::FETCH_ASSOC);*/
    }


    function suche($suche) {


        $search     = '%'.$suche.'%';

        $artikelSql = "SELECT artikelname,artikelnr,artikelbez,hersteller,preis,warengruppe_id,produktbild,verfuegbarkeit 
                    FROM artikel 
                    LEFT JOIN warengruppen 
                        on warengruppe_id = id 
                    WHERE artikelname LIKE ? or artikelbez 
                    LIKE ? or hersteller LIKE ? or preis LIKE ? or warengruppe LIKE ?";
        $sql        = $this->db->prepare($artikelSql);
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


        $artikelSql     = "SELECT artikelnr,artikelname,artikelbez,artikelbeschreibung,hersteller,preis,warengruppe_id,produktbild,verfuegbarkeit 
                        FROM artikel 
                        LEFT JOIN warengruppen 
                            on warengruppe_id = id 
                        WHERE artikelnr = ?";
        $sql            = $this->db->prepare($artikelSql);
        $sql->execute(array($artikelnummer));

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }


    function bewertungArtikel($artikelseite) {
        $artikelnummer = $artikelseite;

        $artikelSql = "SELECT bewertungen.id,
                          nutzer.vorname,
                          bewertungen.sterne,
                          bewertungen.rezension
                    FROM bewertungen 
                        LEFT JOIN artikel on bewertungen.artikel_nr = artikel.artikelnr 
                        LEFT JOIN nutzer on bewertungen.nutzer_id = nutzer.id 
                    WHERE artikelnr = ? AND rezension IS NOT NULL";
        $sql = $this->db->prepare($artikelSql);
        $sql->execute(array($artikelnummer));
        $artikel = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $artikel;
    }

    function durchschnittsBewertung() {

        $artikelSql = "SELECT artikelnr,sterne 
                    FROM artikel
                    LEFT JOIN bewertungen on artikel.artikelnr = bewertungen.artikel_nr";

        $sql        = $this->db->prepare($artikelSql);
        $sql->execute(array());
        $artNr = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $artNr;

    }
    function getNewArticles() {
        $sql  = "SELECT * FROM artikel";
        $stmt = $this->db->query($sql);
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newArticles = [];
        foreach ($info as $inf) {
            $artDate = strtotime($inf['hinzugefuegt']);
            $currentDate = strtotime(date('Y-m-d'));
            $lastAvailableTime = strtotime('-1 month',$currentDate);
            if(($currentDate >= $artDate) && ($lastAvailableTime <= $artDate)) {
                $newArticles[] = $inf;
            }
        }
        return $newArticles;
    }
    function popularArticles() {
        $popularArticles = [];
        $articles = $this->getLastArticles();
        $sql = "SELECT COUNT(bestelldetails.id) AS total,
                       SUM(menge) AS quantity  
                FROM bestelldetails LEFT JOIN bestellungen ON(bestell_nr = bestellungen.id)  
                WHERE bestell_datum <= CURRENT_DATE AND bestell_datum >= DATE(NOW() - INTERVAL 1 MONTH)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $allVariablesForAverege = $stmt->fetch(PDO::FETCH_ASSOC);
        $average = $allVariablesForAverege['quantity'] / $allVariablesForAverege['total'];
        if($average != 1) {
            foreach ($articles as $article) {
                //var_dump($article['artikel_nr']);
                $sql = "SELECT SUM(menge) AS total
                        FROM `bestellungen` 
                        LEFT JOIN bestelldetails ON(bestellungen.id = bestell_nr) 
                        WHERE bestell_datum <= CURRENT_DATE AND bestell_datum >= DATE(NOW() - INTERVAL 1 MONTH) AND artikel_nr = :articleId";
                $stmt = $this->db->prepare($sql);
                $data = [
                    ':articleId' => $article['artikel_nr']
                ];
                $stmt->execute($data);
                $sum = $stmt->fetch(PDO::FETCH_ASSOC);
                if ( $sum['total'] >= $average) {
                    $popularArticles[] = $article;
                }
            }
        }
        if(!empty($popularArticles)) {
            $popularArticles = $this->getArticles($popularArticles);
        }
        return $popularArticles;
        //SELECT * FROM `bestellungen` WHERE bestell_datum <= CURRENT_DATE AND bestell_datum >= DATE(NOW() - INTERVAL 1 MONTH);
    }
    function getArticles($articles) {
        $art = [];
        foreach ($articles as $article) {
            $sql = "SELECT * FROM `artikel` WHERE artikelnr = :articleId";
            $stmt = $this->db->prepare($sql);
            $data = [
                ':articleId' => $article['artikel_nr']
            ];
            $stmt->execute($data);
            $art[] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $art;
    }
    function getLastArticles() {
        $sql = "SELECT DISTINCT artikel_nr 
                FROM `bestellungen` 
                LEFT JOIN bestelldetails ON(bestellungen.id = bestell_nr) 
                WHERE bestell_datum <= CURRENT_DATE AND bestell_datum >= DATE(NOW() - INTERVAL 1 MONTH)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getWarengruppen() {
        $sql = "SELECT warengruppe,Mwst,rabatte_id,rabatt 
                FROM warengruppen 
                    LEFT JOIN mehrwertsteuer 
                        ON(mehrwertsteuer = Mwst_id)
                    LEFT JOIN rabatte 
                        ON rabatte_id = rab_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array());
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getWarengruppeDetail($wareng, $warengAll) {
        $array = [];
        if($wareng) {
            $sql = "SELECT * 
                FROM warengruppen
                    LEFT JOIN mehrwertsteuer 
                        ON(mehrwertsteuer = Mwst_id)
                    LEFT JOIN rabatte 
                        ON rabatte_id = rab_id
                WHERE warengruppe = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($_GET['warengruppe']));
            $array['Warengruppe'] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        $sql = "SELECT * FROM rabatte";
        $stmt = $this->db->query($sql);
        $array['alleRab'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM mehrwertsteuer";
        $stmt = $this->db->query($sql);
        $array['steuer'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($warengAll) {
            $sql = "SELECT warengruppe, id FROM warengruppen";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $array['wareng'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }
    function articlelist() {
        $artikelSql = "SELECT * 
                        FROM artikel 
                        LEFT JOIN warengruppen 
                            on warengruppe_id = id
                        LEFT JOIN mehrwertsteuer
                            ON(mehrwertsteuer = Mwst_id)
                        ORDER BY artikelnr  ASC";
        $sql        = $this->db->query($artikelSql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    function getArticleInfo() {
        $array = [];
        $sql = "SELECT artikelname,
                       artikelnr,
                       artikelbez,
                       artikelbeschreibung,
                       hersteller,
                       preis,
                       warengruppe_id,
                       produktbild,
                       verfuegbarkeit,
                       lagerbestand,
                       warengruppe,
                       artikel.rabatt AS'artRabId',
                       rab_id,
                       rabatte.rabatt               
                FROM artikel
                LEFT JOIN warengruppen
                    ON(warengruppe_id = warengruppen.id)
                LEFT JOIN rabatte 
                    ON(artikel.rabatt = rab_id)
                WHERE artikelnr = :articlenr";
        $stmt = $this->db->prepare($sql);
        $data = [
            ':articlenr' => $_GET['artikelnr']
        ];
        $stmt->execute($data);
        $array['art'] = $stmt->fetch(PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM rabatte";
        $stmt = $this->db->query($sql);
        $array['alleRab'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sql = "SELECT warengruppe, id FROM warengruppen";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $array['wareng'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
}

