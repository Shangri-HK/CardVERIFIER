<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 31/03/2015
 * Time: 15:14
 */

include('func.php');


$mysqli = db_connect();

if (isset($_COOKIE['user'])) {
    $userId = get_userID($mysqli, $_COOKIE['user']);
    $row = $userId->fetch_array(MYSQLI_BOTH);
    $userId = $row['id'];
    $totalPrice = get_priceCart($mysqli, $userId);

    $result = get_userCart($mysqli, $userId);
}

?>

<!DOCTYPE html>
<html>
<?php include ('header.php'); ?>
<body onload="thousand_coma_total(<?= $totalPrice ?>)">
<div>

    <hr>
    <h1>Recap of your order</h1>
    <hr>
<div>
    <a style="float: left" class="btn btn-default btn-lg" disabled>Your cart</a>

        <a class="btn btn-lg btn-default" id="totalCart" disabled style="float: right;"></a>
</div>

    <br>
    <br>
    <br>
    <br>
    <br>

    <table class="table table-hover">
        <tr>
            <th>Name</th>
            <th>Name Merchant</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            </tr>
            <tr>
            <?php
            $i = 0;

            while($row = $result->fetch_array(MYSQLI_BOTH)) {
                ?>

                <td>
                    <?= $row['Name'] ?>
                </td>
                <td>
                    <?= $row['NameMerch'] ?>
                </td>
                <td>
                    <?= $row['price'] ?> €
                </td>
                <td>
                    x<?= $row['quantity'] ?>
                </td>
                <td>
                    <?= $row['price'] * $row['quantity'] ?> €
                </td>

</tr>
                <?php

            }
            ?>

    </table>

    </div>

<?php
$user = get_userInfo($mysqli, $userId);
$uRow = $user->fetch_array(MYSQLI_BOTH);
?>
<div>
<hr>
<a style="float: left" class="btn btn-default btn-lg" disabled>Shipment Informations</a>

    <br>
    <br>
    <br>

<table class="table table-hover">
    <tr>
        <th>
            First Name :
        </th>
        <td>
            <?= $uRow['fname'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Last Name :
        </th>
        <td>
            <?= $uRow['lname'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Email :
        </th>
        <td>
             <?= $uRow['email'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Address :
        </th>
        <td>
            <?= $uRow['address1'] . $uRow['address2'] ?>
        </td>
    </tr>
    <tr>
        <th>
            City :
        </th>
        <td>
            <?= $uRow['city'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Country:
        </th>
        <td>
            <?= $uRow['country'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Postal Code :
        </th>
        <td>
            <?= $uRow['postalCode'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Telephone :
        </th>
        <td>
            <?= $uRow['tel'] ?>
        </td>
    </tr>

    </table>


</div>

<hr>

<a class="btn btn-primary btn-lg">Confirm</a>

<hr>


<script type="text/javascript">
    function thousand_coma_total(total) {
        total = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("totalCart").innerHTML = "Total : "+total+" €";
    }
</script>

</body>
</html>



