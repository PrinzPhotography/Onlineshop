<?php

class User {
private $db;
function __construct() {
    require_once ('Database.php');
    $dataBase = new Database();
    $this->db = $dataBase->getDB();
}
function getUserInfo($id) {
    $sql = "SELECT zahlungsart FROM nutzer WHERE id = :user";
    $stmt = $this->db->prepare($sql);
    $data = [
        ':user' => $id
    ];
    $stmt->execute($data);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getFavAdress($id) {
    session_start();
    $favAdr = NULL;
    $sql = "SELECT
                adressen_id
            FROM
                kundenadressen
            WHERE
                favorit  = :fav
            AND kundennr = :userId";
    $stmt = $this->db->prepare($sql);
    $data = [
        ':fav'    => 'favorit',
        ':userId' => $id
    ];
    $stmt->execute($data);
    $rowCount = (bool)$stmt->rowCount();
    if($rowCount){
        $favAdr = $stmt->fetch(PDO::FETCH_ASSOC)['adressen_id'];
    }
    return $favAdr;
}
function setSession($row): void {
    session_start();
    $zahlung = $this->getUserInfo($row['id']);
    $favAdr  = $this->getFavAdress($row['id']);
    $_SESSION['zahlung']   = $zahlung['zahlungsart'];
    $_SESSION['id']        = $row['id'];
    $_SESSION['favAdr']    = $favAdr;
    if($row['rolle'] == 'admin') {
        $_SESSION['admin'] = $row['rolle'];
    }
}

}