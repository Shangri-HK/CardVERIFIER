<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 27/03/2015
 * Time: 11:21
 */

include('func.php');
include('header.php');

if (isset($_GET['mod']) || isset($_POST['mod'])) {
    $flag = true;
    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
    }
    else if (isset($_POST['userId'])) {
        $userId = $_POST['userId'];
    }
    $user = get_userInfo($mysqli, $userId);
    $uRow = $user->fetch_array(MYSQLI_BOTH);
}
else
    $flag = false;
?>


<form class="form-group" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="col-md-4">
        <label for="username">Username :</label>
        <?php
            if ($flag)
                echo '<p id="username" name="username">'.$uRow['username'].'</p>';
            else
                echo'<input class="form-control" type="text" id="username" name="username" >';
        ?>
        <br>
        <?php
        if ($flag)
            echo '<label for="oldpass">Old Password :</label>
                    <input class="form-control" type="password" id="oldpass" name="oldpass">
                    <br>';
        ?>
        <label for="pass"><?php echo ($flag) ? 'New ' : '' ?>Password :</label>
        <input class="form-control" type="password" id="pass" name="pass" >
        <br>
        <label for="passVer">Check <?php echo ($flag) ? ' New ' : '' ?> Password :</label>
        <input class="form-control" type="password" id="passVer" name="passVer" >
        <br>
        <label for="email">Email :</label>
        <input class="form-control" type="email" id="email" name="email" value="<?php echo ($flag) ? $uRow['email'] : ''?>">
        <br>
        <label for="fname">First Name :</label>
        <input class="form-control" type="text" id="fname" name="fname" value="<?php echo ($flag) ? $uRow['fname'] : ''?>">
        <br>
        <label for="lname">Last Name :</label>
        <input class="form-control" type="text" id="lname" name="lname" value="<?php echo ($flag) ? $uRow['lname'] : ''?>">
        <br>
        <label for="addressrow1">Address 1 :</label>
        <input class="form-control" type="text" id="addressrow1" name="addressrow1" value="<?php echo ($flag) ? $uRow['address1'] : ''?>">
        <br>
        <label for="addressrow2">Address 2 :</label>
        <input class="form-control" type="text" id="addressrow2" name="addressrow2" value="<?php echo ($flag) ? $uRow['address2'] : ''?>">
        <br>
        <label for="city">City :</label>
        <input class="form-control" type="text" id="city" name="city" value="<?php echo ($flag) ? $uRow['city'] : ''?>">
        <br>
        <label for="country">Country :</label>
        <input class="form-control" type="text" id="country" name="country" value="<?php echo ($flag) ? $uRow['country'] : ''?>">
        <br>
        <label for="postalcode">Postal Code :</label>
        <input class="form-control" type="number" id="postalcode" name="postalcode" value="<?php echo ($flag) ? $uRow['postalCode'] : ''?>">
        <br>
        <label for="tel">Telephone :</label>
        <input class="form-control" type="tel" id="tel" name="tel" value="<?php echo ($flag) ? $uRow['tel'] : ''?>">
        <br>
        <?php
        if ($flag) {
            echo '<input class="form-control" type="text" id="mod" name="mod" value="1" style="display: none">';
            echo '<input class="form-control" type="text" id="userId" name="userId" value="'.$userId.'" style="display: none">';
        }
        ?>
        <button class="btn btn-lg btn-info" type="submit" name="submit" id="submit" value="1">Register</button>
    </div>
</form>

<?php


if (!empty($_POST['submit'])) {
    $submit = $_POST['submit'];
}

if (isset($submit)) {
    if ($_POST['pass'] == $_POST['passVer']) {
        if ($flag) {
            $username = $uRow['username'];
        }
        else {
            $username = $_POST['username'];
        }
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address1 = $_POST['addressrow1'];
        $address2 = $_POST['addressrow2'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postalCode = $_POST['postalcode'];
        $tel = $_POST['tel'];

        //CONNECTION DB
        $mysqli = db_connect();

        if ($flag) {
            //UPDATE USER
            update_user($mysqli, $userId, $username, $pass, $email, $fname, $lname, $address1, $address2, $city, $country, $postalCode, $tel);
            echo '<meta http-equiv="refresh" content="0;URL=account.php?update=1">';
        }
        else {
            //NEW USER
            new_user($mysqli, $username, $pass, $email, $fname, $lname, $address1, $address2, $city, $country, $postalCode, $tel);
            echo '<meta http-equiv="refresh" content="0;URL=connection.php?fromreg=1">';
        }

        echo 'You are now registered ! You can now login here : <a href="connection.php">Login</a>';
    }
    else
        echo 'Passwords must match!';






}