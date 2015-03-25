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
<head>
    <title>CardVERIFIER</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


    <style>
        .starter-template {
            margin-top: 70px;
        }

    </style>
    <meta charset="UTF-8">
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://localhost/CardVERIFIER/index.php">Card VERIFIER</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- add some sections in navbar -->
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
    <div class="container">
        <div class="starter-template">
            <form class="form-group" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="col-md-4">
                <label for="username">Username :</label>
                <input class="form-control" type="text" id="username" name="username" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''?>">

                <label for="pass">Password :</label>
                <input class="form-control" type="password" id="pass" name="pass" value="<?php echo (isset($_POST['pass'])) ? $_POST['pass'] : ''?>">
<br>
                <button class="btn btn-lg btn-info" type="submit" name="submit" id="submit" value="1">Sign In</button>

                    <button class="btn btn-lg btn-info" style="float:right" href="register.php">Register</button>
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

    echo $_COOKIE['user'];
    echo $_COOKIE['pass'];

}
?>
        </div>
    </div>
</body>
</html>