<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 27/03/2015
 * Time: 11:21
 */

include('func.php');
include('header.php');
?>


<form class="form-group" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="col-md-4">
        <label for="username">Username :</label>
        <input class="form-control" type="text" id="username" name="username" >

        <label for="pass">Password :</label>
        <input class="form-control" type="password" id="pass" name="pass" >
        <br>
        <label for="passVer">Check Password :</label>
        <input class="form-control" type="password" id="passVer" name="passVer" >
        <br>
        <label for="email">Email :</label>
        <input class="form-control" type="email" id="email" name="email" >
        <br>
        <label for="fname">First Name :</label>
        <input class="form-control" type="text" id="fname" name="fname" >
        <br>
        <label for="lname">Last Name :</label>
        <input class="form-control" type="text" id="lname" name="lname" >
        <br>
        <label for="addressrow1">Address 1 :</label>
        <input class="form-control" type="text" id="addressrow1" name="addressrow1" >
        <br>
        <label for="addressrow2">Address 2 :</label>
        <input class="form-control" type="text" id="addressrow2" name="addressrow2" >
        <br>
        <label for="city">City :</label>
        <input class="form-control" type="text" id="city" name="city" >
        <br>
        <label for="country">Country :</label>
        <input class="form-control" type="text" id="country" name="country" >
        <br>
        <label for="postalcode">Postal Code :</label>
        <input class="form-control" type="number" id="postalcode" name="postalcode" >
        <br>
        <label for="tel">Telephone :</label>
        <input class="form-control" type="tel" id="tel" name="tel" >
        <br>
        <button class="btn btn-lg btn-info" type="submit" name="submit" id="submit" value="1">Register</button>
    </div>
</form>

<?php


if (!empty($_POST['submit'])) {
    $submit = $_POST['submit'];
}

if (isset($submit)) {
    if ($_POST['pass'] == $_POST['passVer']) {
        $username = $_POST['username'];
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

        //NEW USER
        new_user($mysqli, $username, $pass, $email, $fname, $lname, $address1, $address2, $city, $country, $postalCode, $tel);

        echo 'You are now registered ! You can now login here : <a href="connection.php">Login</a>';
    }
    else
        echo 'Passwords must match!';






}