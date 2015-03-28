<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 27/03/2015
 * Time: 13:15
 */


include ('func.php');

$mysqli = db_connect();

$result = db_query_articles($mysqli);

if (isset($_COOKIE['user'])) {
    $resultUser = get_userID($mysqli, $_COOKIE['user']);
    $rowUser = $resultUser->fetch_array(MYSQLI_BOTH);
}
?>

<!DOCTYPE html>
<html>
<?php include ('header.php'); ?>
<body>
<div>

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
                    <td><h2><?= $row['Name'].' ('.$row['NameMerch'].')' ?></h2></td>
                </tr>
                <tr style="height: 100px">
                    <td><img style="float: left" class="img-thumbnail" src="<?= $row['img'] ?>" alt="Picture" width="100" height="100">

                        <h1><?= $row['price'] ?> €</h1></td>
                </tr>

                <tr style="height: 100px">
                    <td><p style="font-style: italic; text-align: justify;"><?= $row['Desc'] ?></p></td>
                </tr>

                <tr style="height: 100px">
                    <td><a style="float:left;" target="_blank" class="btn btn-default btn-md" href="<?= $row['website'] ?>"><?= $row['NameMerch'] ?></a>
    <?php
    if (isset($_COOKIE['user'])) {
                      ?><a class="btn btn-default btn-lg" href="addtocart.php?id=<?= $row['idProd'] ?>&userId=<?php echo (isset($_COOKIE['user'])) ? $rowUser['id'] : '' ?>">Add to Cart!</a><?php
 } ?>
                        <a style="float:right;" target="_blank" class="btn btn-default btn-md" href="<?= $row['ProdWebsite'] ?>"><?= $row['Name'] ?></a></td>
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