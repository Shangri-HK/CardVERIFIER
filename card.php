<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 20/03/2015
 * Time: 09:10
 */

include ('func.php');
?>

<!DOCTYPE html>
<html>
<?php include ('header.php'); ?>
<body>
<?php
if (isset($_COOKIE['user'])) {
    $userId = $_COOKIE['user'];
}

?>
        <h2 id="title">Please, verify your card</h2>
        <br>
        <p style="font-style: italic; color: #CCC">In order to check your card type, & proceed to payment.</p>
        <br>
        <br>
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

//PARSING NUMBERS
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
<hr>
        <h3  class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            VALID CARD NUMBER !</h3>
<hr>
<a class="btn btn-lg btn-default" href="payment.php">Proceed >></a>
<hr>

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
<script>
    function delete_cookie( name ) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
</script>
</html>