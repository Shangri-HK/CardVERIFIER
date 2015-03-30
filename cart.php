<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 28/03/2015
 * Time: 12:28
 */
include('func.php');


$mysqli = db_connect();

if (isset($_COOKIE['user'])) {
    $userId = get_userID($mysqli, $_COOKIE['user']);
    $row = $userId->fetch_array(MYSQLI_BOTH);
    $userId = $row['id'];

    $result = get_userCart($mysqli, $userId);
}
//DELETE = 0 & IDPROD=X : Drop all articles for 1 IDPROD
//DELETE = all : Drop all
//DELETE isset AND != 0 AND != all & IDPROD = X : Drop 1 article for 1 IDPROD
if (isset($_GET['delete'])) {
    if ($_GET['delete'] == '0') {
        $idProd = $_GET['idProd'];
        drop_multiArtCart($mysqli, $userId, $idProd);
    }
    else if ($_GET['delete'] == 'all') {
        drop_allArt($mysqli, $userId);
    }
    else if ($_GET['delete'] != 0 && $_GET['delete'] != 'all') {
        $idProd = $_GET['delete'];
        drop_oneArt($mysqli, $userId, $idProd);
    }
    ?>
    <meta http-equiv="refresh" content="0;URL=cart.php">
<?php
}
?>
<!DOCTYPE html>
<html>
<?php include ('header.php'); ?>
<body>

<div>
<hr>
    <button class="btn btn-primary btn-lg">
        <span class="glyphicon glyphicon-euro" aria-hidden="true"></span> PURCHASE CART
    </button>

    <a style="float: right" href="cart.php?delete=all" class="btn btn-danger btn-lg">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> RESET CART
    </a>
<hr>
    <br>
    <br>

    <table>
        <tr>
            <?php
            $i = 0;

            while($row = $result->fetch_array(MYSQLI_BOTH)) {
                ?>

                <td>

                <article>
                <table>
                <tr style="height: 100px">
                    <td><h2><?= $row['Name'] . ' (' . $row['NameMerch'] . ')' ?></h2></td>
                </tr>
                <tr style="height: 100px">
                    <td><img style="float: left" class="img-thumbnail" src="<?= $row['img'] ?>" alt="Picture"
                             width="100" height="100">

                        <h1><?= $row['price'] ?> €</h1></td>
                </tr>

                <tr style="height: 100px">
                    <td><p style="font-style: italic; text-align: justify;"><?= $row['Desc'] ?></p></td>
                </tr>

                <tr style="height: 75px">
                <td><button style="float: left" disabled>Quantity : <?= $row['quantity'] ?></button>

                    <a style="float: right" href="cart.php?delete=0&idProd=<?= $row['idProd'] ?>" type="button" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>

                    <a style="float : right" type="button" href="cart.php?delete=<?= $row['idProd'] ?>" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                </td>


                    </tr>
                    </table>
                    </article>

                    </td>

                    <?php
                    $i++;
                    if ($i > 2) {
                        echo '</tr><tr>';
                        $i = 0;
                    }

            }
            ?>


</div>

</body>
</html>

