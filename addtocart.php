<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 27/03/2015
 * Time: 15:43
 */
include('func.php');


$id = $_GET['id'];
$userId = $_GET['userId'];

$mysqli = db_connect();

addToCart($mysqli, $userId, $id);
?>

<meta http-equiv="refresh" content="0;URL=index.php">