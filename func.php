<?php
/**
 * Created by PhpStorm.
 * User: Hardcore
 * Date: 25/03/2015
 * Time: 10:42
 */

function db_connect() {
    $mysqli = new mysqli("localhost", "root", "", "cardverifier");
    if ($mysqli->connect_errno) {
        echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    return $mysqli;
}

function login($mysqli, $username, $pass) {
    $pass = sha1($pass);
    $query = "SELECT * FROM users WHERE username = '".$username."' AND pass = '".$pass."';";
    $result = $mysqli->query($query);

    return $result;
}

function new_user($mysqli, $username, $pass) {
    $hashedPass = sha1($pass);
    $query = "INSERT INTO users (`id`, `username`, `pass`, `cart`) VALUES (NULL, '".$username."', '".$hashedPass."', NULL);";

    $result = $mysqli->query($query);

    return $result;
}

function get_userID($mysqli, $username) {
    $query = "SELECT id FROM users WHERE username = '".$username."'";
    $results = $mysqli->query($query);

    return $results;
}

function db_query($mysqli, $prefix, $digits) {
    $query = "Select * FROM cards WHERE prefix = ".$prefix." AND digits = ".$digits.";";
    $result = $mysqli->query($query);

    return $result;
}

function db_query_articles($mysqli) {
    $query = "SELECT * FROM products INNER JOIN merchants ON products.idMerch =  merchants.idMerch";
    $result = $mysqli->query($query);

    return $result;
}

function addToCart($mysqli, $userId, $id) {
    $query = "INSERT INTO usercart (`idUser`, `storedProdId`) VALUES ('".$userId."', '".$id."');";
    $result = $mysqli->query($query);

    return $result;
}


function is_valid_luhn($number) {
    settype($number, 'string');
    $sumTable = array(
        array(0,1,2,3,4,5,6,7,8,9),
        array(0,2,4,6,8,1,3,5,7,9));
    $sum = 0;
    $flip = 0;
    for ($i = strlen($number) - 1; $i >= 0; $i--) {
        $sum += $sumTable[$flip++ & 0x1][$number[$i]];
    }
    return $sum % 10 === 0;
}

function logout () {
    setcookie("user", "", time()-1);
}