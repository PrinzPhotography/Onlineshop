<?php

class Database
{
    function getDB(){
        $host = "azubi-shop.dssrz.com";
        $name = "shop";
        $user = "admin";
        $passwort = "Test1234";
        $mysql = new PDO ("mysql:host=$host;dbname=$name", $user, $passwort);
        return $mysql;
    }
}