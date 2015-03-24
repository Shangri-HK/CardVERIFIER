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
$types = array (
'visa' => array('4024', '4485', '4532', '4539', '4556', '4716', '4916', '4929'), /* 13 or 16 digits*/
'visa Electron' => array('4026', '4175', '4508', '4844', '4913', '4917'), // 16 digits
'voyager' => array('8699'), // 15 digits
'master-Card' => array('51', '52', '53', '54', '55'), // 16 digits
'laser (16 digits)' => array('6304', '6706', '6709', '6771'), // 16 digits
'laser (17 digits)' => array('6304', '6706', '6709', '6771'), // 17 digits
'laser (18 digits)' => array('6304', '6706', '6709', '6771'), // 18 digits
'laser (19 digits)' => array('6304', '6706', '6709', '6771'), // 19 digits
'jcb Co Inc (15 digits)' => array('1800', '2100'), // 15 digits
'jcb Co Inc (16 digits)' => array('3088', '3096', '3112', '3158', '3337', '3528'), // 16 digits
'instaPayment' => array('637', '638', '639'), // 16 digits
'enRoute' => array('2014', '2149'), // 15 digits
'discover' => array('6011', '644', '645', '646', '647', '649', '65'), // 16 digits
'diner Club (USA & CA)' => array('54'), // 16 digits
'diner Club (International)' => array('36', '38'), // 14 digits
'diner Club (Carte Blanche)' => array('300', '301', '302', '303', '304', '305'), // 14 digits
'american express' => array('34', '37'), // 15 digits
)
?>

<!DOCTYPE html>
<html>
<head>
    <title>CardVERIFIER</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <style>
        .starter-template {
            margin-top: 70px;
        }

    </style>
    <meta charset="UTF-8">
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
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
    </div>
</div>
<div class="container">
    <div class="starter-template">

        <h2>VERIFY A CARD NUMBER NOW !</h2>
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

//QUERY DB
$result = db_query($mysqli, $prefix2, $digits);

$row = $result->fetch_array(MYSQLI_BOTH);
$row_cnt = $result->num_rows;






$type='null';





$luhnDgt = substr($cardno, -1, 1); // Luhn Digit Check (last)


if ($digits < 1) {
    echo '<h2 class="alert alert-danger">
        <span class="glyphicon glyphicon-remove"></span>
        Error : card number is too short !</h2>';
    die;
}


    if(is_valid_luhn($cardno) == false) {
        ?>
        <h3>xTODO</h3>
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
        <h3>xTODO</h3>
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
                                    <td>xTODO</td>
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
</body>
</html>