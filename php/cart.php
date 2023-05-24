<?php

class Cart
{
    private $db;

    function __construct() {
        require_once ('Database.php');
        $dbConnection = new Database();
        $this->db = $dbConnection->getDB();
    }
    function updateCart($quantity, $userId, $articleId) {
        $stmt = $this->db->prepare("UPDATE warenkorb
                                    SET anzahl = :newQuantity
                                    WHERE nutzer_id = :userId
                                      AND artikel_id = :article");
        if($stmt === false) {
            return false;
        }
        $stmt->execute([
            ':newQuantity' => $quantity,
            ':userId' => $userId,
            ':article'=> $articleId
        ]);
    }
    function checkCartItem($article_nr) {
        $cartResults = $this->db->prepare("SELECT *
                                           FROM artikel
                                           WHERE artikelnr = :article_nr");
        $cartResults->bindParam(':article_nr', $article_nr);
        $cartResults->execute();

        if($cartResults === false) {
            return false;
        }
        return $cartResults->fetchColumn();
    }

    function addProductToCart($userId, $productId, $quantity = 1) {

        $sql = "INSERT INTO warenkorb
            SET anzahl=:quantity,
                nutzer_id = :userId,
                artikel_id = :productId ON DUPLICATE KEY
            UPDATE anzahl = anzahl +:quantity";
        $statement = $this->db->prepare($sql);
        $data = [
            ':userId' => $userId,
            ':productId' => $productId,
            ':quantity' => $quantity
        ];
        $statement->execute($data);
    }

    function getCartItemsForUserId($userId): array {
        if($userId === 0) {
            return [];
        }
        $sql = "SELECT artikel_id,
                   artikelname,
                   artikelbez,
                   preis,
                   anzahl,
                   produktbild
            FROM warenkorb
            JOIN artikel ON(warenkorb.artikel_id = artikel.artikelnr)
            WHERE nutzer_id = :userId";
        $statement = $this->db->prepare($sql);
        if(false === $statement) {
            return [];
        }
        $data = [
            ':userId' => $userId
        ];
        $statement->execute($data);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCartSumForUserId($userId) {
        if($userId === 0) {
            return 0;
        }
        $sql = "SELECT SUM(preis * anzahl),
                   SUM(anzahl)
            FROM warenkorb
            JOIN artikel ON(warenkorb.artikel_id = artikel.artikelnr)
            WHERE nutzer_id = :userId";
        $result = $this->db->prepare($sql);
        if($result === false) {
            return 0;
        }
        $data = [
            ':userId' => $userId
        ];
        $result->execute($data);
        return $result->fetch();
    }

    function deleteProductInCartForUserId($userId, $productId) {
        $sql = "DELETE
            FROM warenkorb
            WHERE nutzer_id = :userId
              AND artikel_id = :productId";

        $statement = $this->db->prepare($sql);
        if($statement === false) {
            return 0;
        }
        $data = [
            ':userId' => $userId,
            ':productId' => $productId
        ];
        return $statement->execute(
            $data
        );
    }

    function getCountCartNumber($id) {
        $cartResults = $this->db->prepare("SELECT COUNT(id)
                                           FROM warenkorb
                                           WHERE nutzer_id = :id");
        $cartResults->bindParam(':id', $id);
        $cartResults->execute();
        return $cartResults->fetchColumn();
    }

    function moveCartToAnotherUser($cookie, $userId) {
        $stmt = $this->db->prepare('SELECT *
                                    FROM warenkorb
                                    WHERE nutzer_id = :user');
        if($stmt === false) {
            return false;
        }
        $stmt->execute([':user' => $cookie]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $cartInfo) {

            $quantity = $cartInfo['anzahl'];
            $article_id = $cartInfo['artikel_id'];
            $duplicateArticle = $this->checkDublicatedArticles($article_id, $userId);

            if($duplicateArticle === false) {
                //
                //Just do an update on nutzer_id where nutzer_id === $cookieId to $_SESSION['id']
                $stmt = $this->db->prepare("UPDATE warenkorb
                                            SET nutzer_id = :newUser
                                            WHERE nutzer_id = :oldUser");
                if($stmt === false) {
                    continue;
                }
                $stmt->execute([
                    ':newUser' => $userId,
                    ':oldUser' => $cookie
                ]);
            } else {
                //get anzahl where nutzer_id is like $cookie and add it to the already existing value of anzahl and afterwards delte every
                // row in the database table wherenutzer_id is like $cookie
                $stmt = $this->db->prepare("UPDATE warenkorb
                                            SET anzahl = anzahl + :quantity
                                            WHERE nutzer_id = :user
                                              AND artikel_id = :article");
                if($stmt === false) {
                    continue;
                }
                $stmt->execute([
                    ':quantity' => $quantity,
                    ':user' => $userId,
                    ':article' => $article_id
                ]);
                if(!$stmt) {
                    // Wenn es nicht ausgeführ wurde, soll nichts geschehen
                    continue;
                } else {
                    // Wenn das update der nutzer_id erfolgreich war, soll der cookie eintrag gelöscht werden
                    $stmt = $this->db->prepare("DELETE
                                                FROM warenkorb
                                                WHERE nutzer_id = :user
                                                  AND artikel_id = :article");
                    if ($stmt === false) {
                        continue;
                    }
                    $stmt->execute([
                        ':user' => $cookie,
                        ':article' => $article_id
                    ]);
                }
            }

        }
    }

    function checkDublicatedArticles($article, $user) {
        $stmt = $this->db->prepare("SELECT anzahl
                                    FROM warenkorb
                                    WHERE artikel_id = :article
                                      AND nutzer_id = :user");
        if($stmt === false) {
            return false;
        }
        $stmt->execute(
            [':article' => $article,
                ':user' => $user]
        );
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(empty($result)) {
            return false;
        }
        return $result;
    }
}