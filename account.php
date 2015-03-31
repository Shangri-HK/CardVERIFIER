<?php
/**
 * Created by PhpStorm.
 * User: Hardcore
 * Date: 31/03/2015
 * Time: 16:58
 */

include('func.php');

$mysqli = db_connect();

if (isset($_COOKIE['user'])) {
    $userId = get_userID($mysqli, $_COOKIE['user']);
    $row = $userId->fetch_array(MYSQLI_BOTH);
    $userId = $row['id'];
}

$user = get_userInfo($mysqli, $userId);
$uRow = $user->fetch_array(MYSQLI_BOTH);

if(isset($_GET['update']) && $_GET['update'] == '1') {
    $update = true;
}
else
    $update = false;
?>

<!DOCTYPE html>
<html>

<!-- HEADER -->
<?php include ('header.php'); ?>

<body>

<hr>

<h1>My Account</h1>

<hr>

<div>

    <br>
    <br>

    <table class="table table-hover">
        <tr>
            <th>
                Username :
            </th>
            <td>
                <?= $uRow['username'] ?>
            </td>
        </tr>
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

    <hr>
    <a class="btn btn-default btn-lg" href="register.php?mod=1&userId=<?= $userId ?>">Modify</a>
    <hr>

</div>

</body>

</html>