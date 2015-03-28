<?php
/**
 * Created by PhpStorm.
 * User: Hardcore
 * Date: 25/03/2015
 * Time: 10:23
 */

            include('func.php');

?>
<!DOCTYPE html>
<html>
            <?php include("header.php"); ?>
<body>


            <form class="form-group" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="col-md-4">
                <label for="username">Username :</label>
                <input class="form-control" type="text" id="username" name="username" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''?>">

                <label for="pass">Password :</label>
                <input class="form-control" type="password" id="pass" name="pass" value="<?php echo (isset($_POST['pass'])) ? $_POST['pass'] : ''?>">
<br>
                <button class="btn btn-lg btn-info" type="submit" name="submit" id="submit" value="1">Sign In</button>

                    <a class="btn btn-lg btn-info" style="float:right" href="register.php">Register</a>
                </div>
            </form>

<?php

if (!empty($_POST['submit'])) {
    $submit = $_POST['submit'];
}

if (isset($submit)) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    //CONNECTION DB
    $mysqli = db_connect();

    //TRY TO LOGIN
    $result = login($mysqli, $username, $pass);
    $row = $result->fetch_array(MYSQLI_BOTH);

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
?>
        </div>
    </div>
</body>
</html>