<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 27/03/2015
 * Time: 13:15
 */


include ('func.php');

$mysqli = db_connect();

if (!empty($_POST['submit'])) {
    $submit = $_POST['submit'];
}

if (isset($submit)) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    //TRY TO LOGIN
    $log = login($mysqli, $username, $pass);
    $row = $log->fetch_array(MYSQLI_BOTH);

    if (!empty($row)) {
        setcookie('user', $username, time()+3600);
        setcookie('pass', $pass, time()+3600);
        ?>
        <meta http-equiv="refresh" content="0;URL=index.php">
    <?php
    } else {
        $log = false;
    }

}

if (isset($_GET['categ'])) {
    $categ = $_GET['categ'];
    $categlbl = get_categ($mysqli, $categ);
    $categlbl = $categlbl->fetch_array(MYSQLI_BOTH);
    $categlbl = $categlbl['lblCateg'];
}
else {
    $categ = 0;
}

$result = db_query_articles($mysqli, $categ);


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
    <hr>
    <h2 style="text-align: center">Products <?php echo (isset($categlbl)) ? ' - '.$categlbl : '' ?></h2>
    <hr>
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
                    <td><p style="font-style: italic; text-align: justify;"><?= substr($row['Desc'], 0, 150) ?>...</p></td>
                </tr>

                <tr style="height: 70px">
                    <td><a style="float:left;" target="_blank" class="btn btn-default btn-md" href="<?= $row['website'] ?>"><?= $row['NameMerch'] ?></a>
    <?php
    if (isset($_COOKIE['user'])) {
                      ?><a class="btn btn-default btn-lg" href="cart.php?idProd=<?= $row['idProd'] ?>">Add to Cart!</a><?php
 } ?>
                        <a style="float:right;" target="_blank" class="btn btn-default btn-md" href="<?= $row['ProdWebsite'] ?>"><?=  substr($row['Name'], 0, 15) ?></a></td>
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

