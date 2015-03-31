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

function new_user($mysqli, $username, $pass, $email, $fname, $lname, $address1, $address2, $city, $country, $postalCode, $tel) {
    $hashedPass = sha1($pass);
    $query = "INSERT INTO users (`id`, `username`, `pass`, `email`, `fname`, `lname`, `address1`, `address2`, `city`, `country`, `postalCode`, `tel`)
              VALUES (NULL, '".$username."', '".$hashedPass."', '".$email."', '".$fname."', '".$lname."', '".$address1."', '".$address2."', '".$city."', '".$country."', '".$postalCode."', '".$tel."')";

    $result = $mysqli->query($query);

    return $result;
}

function update_user($mysqli, $userId, $username, $pass, $email, $fname, $lname, $address1, $address2, $city, $country, $postalCode, $tel) {
    $hashedPass= sha1($pass);
    $query = "UPDATE users SET pass = '".$hashedPass."', email = '".$email."', fname = '".$fname."', lname = '".$lname."', address1 = '".$address1."', address2 = '".$address2."', city = '".$city."', country = '".$country."', postalCode = '".$postalCode."', tel = '".$tel."' WHERE id = ".$userId;

    $result = $mysqli->query($query);
}

function get_userID($mysqli, $username) {
    $query = "SELECT id FROM users WHERE username = '".$username."'";
    $results = $mysqli->query($query);

    return $results;
}

function get_userInfo($mysqli, $userId) {
    $query = "SELECT * FROM users WHERE id = ".$userId;
    $result = $mysqli->query($query);

    return $result;
}

function db_query($mysqli, $prefix, $digits) {
    $query = "Select * FROM cards WHERE prefix = ".$prefix." AND digits = ".$digits.";";
    $result = $mysqli->query($query);

    return $result;
}

function db_query_articles($mysqli, $categ) {

    $query = "SELECT * FROM products INNER JOIN merchants ON products.idMerch =  merchants.idMerch";
    if ($categ != 0) {
        $query .= " WHERE idCateg = ".$categ;
    }

    $result = $mysqli->query($query);

    return $result;
}

function addToCart($mysqli, $userId, $idProd) {

    $query = "SELECT * FROM usercart WHERE storedProdId = ".$idProd;
    $result = $mysqli->query($query);
    $nmrw = $result->num_rows;

    if ($nmrw != 0) {
        $query = "UPDATE usercart SET quantity = quantity + 1 WHERE storedProdId = ".$idProd." AND idUser = ".$userId;

    }
    else {
        $query = "INSERT INTO usercart (`idUser`, `storedProdId`, `quantity`) VALUES ('" . $userId . "', '" . $idProd . "', '1');";
    }

    $result = $mysqli->query($query);

    return $result;
}

function get_userCart($mysqli, $userId) {
    $query = "SELECT * FROM usercart INNER JOIN products ON (usercart.storedProdId = products.idProd) INNER JOIN merchants ON (products.idMerch = merchants.idMerch) WHERE idUser = ".$userId;

    $result = $mysqli->query($query);

    return $result;
}

function drop_userCart($mysqli, $userId) {
    $query = "DELETE FROM usercart WHERE idUser = ".$userId;
    $result = $mysqli->query($query);
}

function drop_multiArtCart($mysqli, $userId, $idProd) {
    $query = "DELETE FROM usercart WHERE idUser = ".$userId." AND storedProdId = ".$idProd;
    $result = $mysqli->query($query);
}

function drop_oneArt($mysqli, $userId, $idProd) {
    $query = "UPDATE usercart SET quantity = quantity - 1 WHERE storedProdId = ".$idProd." AND idUser = ".$userId;
    $result = $mysqli->query($query);
    $query = "SELECT * FROM usercart WHERE storedProdId = ".$idProd;
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_BOTH);
    if ($row['quantity'] == 0) {
        drop_multiArtCart($mysqli, $userId, $idProd);
    }
}

function drop_allArt($mysqli, $userId) {
    $query = "DELETE FROM usercart WHERE idUser = ".$userId;
    $result = $mysqli->query($query);
}

function get_categ($mysqli, $categ) {
    $query = "SELECT * FROM categprod";
    if ($categ != 0)
        $query .= " WHERE idCateg = ".$categ;

    $result = $mysqli->query($query);

    return $result;
}

function get_priceCart($mysqli, $userId) {
    $query = "SELECT SUM(price * quantity) AS total FROM products INNER JOIN usercart ON (products.idProd = usercart.storedProdId)
WHERE idUser = ".$userId;
    $result = $mysqli->query($query);

    $total = $result->fetch_array(MYSQLI_BOTH);

    return $total['total'];
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