<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 20/03/2015
 * Time: 09:10
 */

function db_connect() {
    $mysqli = new mysqli("localhost", "root", "", "cardverifier");
    if ($mysqli->connect_errno) {
        echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    return $mysqli;
}

function db_query($mysqli, $prefix, $digits) {
    $query = "Select * FROM cards WHERE prefix = ".$prefix." AND digits = ".$digits.";";
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

?>

<!DOCTYPE html>
<html>
<head>
    <title>CardVERIFIER</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


    <style>
        .starter-template {
            margin-top: 90px;
        }


    </style>
    <meta charset="UTF-8">
</head>

<body>
<div class="navbar navbar-default"> <!-- inverse navbar-fixed-top -->
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://localhost/CardVERIFIER/index.php">Card VERIFIER</a>

        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- add some sections in navbar -->
            </ul>
        </div><!--/.nav-collapse -->

    <div style="float:right; color:#fff;">
        <?php
        if (isset($_COOKIE['user'])) {
            echo "Hello ".$_COOKIE['user'];
        }
        else {
            echo "<a href='connection.php'>Login</a>";
        }
        ?>
    </div>

    </div>
</div>
<div class="bg">
<div class="container">
    <div class="starter-template">
<?php
if (isset($_COOKIE['user'])) {
    echo $_COOKIE['user'];
}
else {
    echo 'NOCOOKIES';
}
?>
        <h2 id="title">VERIFY A CARD NUMBER NOW !</h2>
        <br>
        <form class="form-group" method="post" action="<?= $_SERVER['PHP_SELF']?>">
            <label for="cardno">Enter the card number :</label>
            <input class="form-control input-lg" id="cardno" type="text" name="cardno" value="<?php echo (isset($_POST['cardno'])) ? $_POST['cardno'] : ''?>">

            <br>
            <br>

            <button class="btn btn-lg btn-default" type="submit" name="submit" id="submit" value="1">INSPECT!</button>
        </form>
<br>
<?php
//CONNECTION DB
$mysqli = db_connect();

//VERIF FORM
if (!empty($_POST['submit'])) {
    $submit = $_POST['submit'];
}

if (isset($submit)) { /*process*/
$cardno = $_POST['cardno'];

//DETECT CARD LENGTH & PREFIXES
$digits = strlen($cardno);
$prefix2 = substr($cardno, 0, 2); // Card number's prefix (2dgt)
$prefix3 = substr($cardno, 0, 3); // Card number's prefix (3dgt)
$prefix4 = substr($cardno, 0, 4); // Card number's prefix (4dgt)

$i = 2;

//QUERY DB, PREFIX ++
while (empty($row)) {
    $prefix = substr($cardno, 0, $i);
    $result = db_query($mysqli, $prefix, $digits);
    $row = $result->fetch_array(MYSQLI_BOTH);
    $i++;
}

if ($digits == 14) {
    if ($row['id'] == 68 || $row['id'] == 69 || $row['id'] == 70 || $row['id'] == 71 || $row['id'] == 72 || $row['id'] == 73) { //CARTE BLANCHE
        $part1 = substr($cardno, 0, 3);
        $part2 = substr($cardno, 3, 4);
        $part3 = substr($cardno, 7, 4);
        $part4 = substr($cardno, 11, 4);
    }
    else {
        $part1 = substr($cardno, 0, 2);
        $part2 = substr($cardno, 2, 4);
        $part3 = substr($cardno, 6, 4);
        $part4 = substr($cardno, 10, 4);
    }
}
else if ($digits ==  15) {
    if ($row['id'] == 56 || $row['id'] == 57 || $row['id'] == 45 || $row['id'] == 46 || $row['id'] == 23 || $row['id'] == 74 || $row['id'] == 75) { // VOYAGER / AMEX / EN ROUTE / JCB CO INC 15
        $part1 = substr($cardno, 0, 4);
        $part2 = substr($cardno, 4, 4);
        $part3 = substr($cardno, 8, 4);
        $part4 = substr($cardno, 12, 3);
    }
    else {
        $part1 = substr($cardno, 0, 3);
        $part2 = substr($cardno, 3, 4);
        $part3 = substr($cardno, 7, 4);
        $part4 = substr($cardno, 11, 4);
    }
}
else if ($digits == 16) {
    $part1 = substr($cardno, 0, 4);
    $part2 = substr($cardno, 4, 4);
    $part3 = substr($cardno, 8, 4);
    $part4 = substr($cardno, 12, 4);
}
else if ($digits == 17) {
    $part1 = substr($cardno, 0, 1);
    $part2 = substr($cardno, 1, 4);
    $part3 = substr($cardno, 5, 4);
    $part4 = substr($cardno, 9, 4);
    $part5 = substr($cardno, 13, 4);
}
else if ($digits == 18) {
    $part1 = substr($cardno, 0, 2);
    $part2 = substr($cardno, 2, 4);
    $part3 = substr($cardno, 6, 4);
    $part4 = substr($cardno, 10, 4);
    $part5 = substr($cardno, 14, 4);
}
else if ($digits == 19) {
    $part1 = substr($cardno, 0, 4);
    $part2 = substr($cardno, 4, 4);
    $part3 = substr($cardno, 8, 4);
    $part4 = substr($cardno, 12, 4);
    $part5 = substr($cardno, 16, 3);
}

$formatNo = $part1.'-'.$part2.'-'.$part3.'-'.$part4;

if (isset($part5))
    $formatNo .= '-'.$part5;

$luhnDgt = substr($cardno, -1, 1); // Luhn Digit Check (last)


if ($digits < 1) {
    echo '<h2 class="alert alert-danger">
        <span class="glyphicon glyphicon-remove"></span>
        Error : card number is too short !</h2>';
    die;
}


    if(is_valid_luhn($cardno) == false) {
        ?>
        <h3><?= $formatNo ?></h3>
        <h3 class="alert alert-danger">
            <span class="glyphicon glyphicon-remove"></span> INVALID CARD NUMBER !</h3>

        <!-- <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Details
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">

                    </div>
                </div>
            </div> -->
        <?php
    }
    else if (is_valid_luhn($cardno) == true) {
        ?>
        <h3><?= $formatNo ?></h3>
        <h3  class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            VALID CARD NUMBER !</h3>

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Details
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>
                                    <th><strong>Card Length : </strong></th>
                                    <td><?= $digits ?> Digits</td>
                                </tr>
                                <tr>
                                    <th><strong>Card Type : </strong></th>
                                    <td><?= $row['label'] ?></td>
                                </tr>
                                <tr>
                                    <th><strong>Formatted : </strong></th>
                                    <td><?= $formatNo ?></td>
                                </tr>
                                <tr>
                                    <th><strong>Luhn Digit : </strong></th>
                                    <td><?= $luhnDgt ?></td>
                                </tr>
                                <tr>
                                    <th><strong>Prefix : </strong></th>
                                    <td><?= $row['prefix'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
        <?php

        $result->free();
        $mysqli->close();
    }
}

?>
    </div>
    </div>
    </div>
</div>
</body>
</html>