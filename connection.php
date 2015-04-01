<?php
/**
 * Created by PhpStorm.
 * User: Hardcore
 * Date: 25/03/2015
 * Time: 10:23
 */

            include('func.php');

if (isset($_GET['fromreg']) && $_GET['fromreg'] == '1') {
    $fromreg = true;
}
else
    $fromreg = false;

?>

<!DOCTYPE html>
<html>
<?php include("header.php"); ?>
<body>

<?php if ($fromreg) {
    echo '<p class="alert alert-info">New ? Thanks for subscription ! (:</p>';
}
if (isset($_GET['log']) && $_GET['log'] == '0') {
    echo '<p class="alert alert-danger">Bad Username/Password ! </p>';
}
?>

            <form class="form-group" action="index.php" method="post">
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


?>
        </div>
    </div>
</body>
</html>