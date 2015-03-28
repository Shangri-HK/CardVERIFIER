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

        //CONNECTION DB
        $mysqli = db_connect();

        //NEW USER
        new_user($mysqli, $username, $pass);

        echo 'You are now registered ! You can now login here : <a href="connection.php">Login</a>';
    }
    else
        echo 'Passwords must match!';






}