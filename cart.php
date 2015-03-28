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

    <button style="float: right" class="btn btn-danger btn-lg">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> RESET CART
    </button>
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

                    <button style="float: right" type="button" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>

                    <button style="float : right" type="button" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
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

