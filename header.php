<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 27/03/2015
 * Time: 11:23
 */

$mysqli = db_connect();
$categs = get_categ($mysqli, 0);



?>


<head>
    <title>CardVERIFIER</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <style>
        .starter-template {
            margin-top: 90px;
        }

        article {
            height: 375px;
            width: 375px;
            border: 1px solid #999;
            border-radius: 10px 10px 10px 10px;
            text-align: center;
            background-color: #EEE;
            display: inline-block;
            padding: 10px;
            margin: 5px;
        }
    </style>
    <meta charset="UTF-8">
</head>


<div class="navbar navbar-inverse navbar-fixed-top"> <!-- inverse navbar-fixed-top -->
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
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown-open">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><?php echo (isset($_COOKIE['user'])) ? $_COOKIE['user'] : 'Not connected' ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php echo (isset($_COOKIE['user'])) ? '<li><a href="#">My account</a></li>
                                                            <li><a href="cart.php">My Cart</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="logout.php">Disconnect</a></li>
                                                            ' : '<li><a href="connection.php">Log In</a></li>' ?>
                    </ul>
                </li>

                <li class="dropdown-open">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Products<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php">All Products</a></li>
                        <li role="presentation" class="divider"></li>

                        <?php
                        while($row = $categs->fetch_array(MYSQLI_BOTH)) { ?>
                            <li><a href="index.php?categ=<?php echo $row['idCateg'] ?>"><?= $row['lblCateg'] ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>

                <!-- add some sections in navbar -->

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                echo (isset($_COOKIE['user'])) ? '<li class="active"><a>Hello '.$_COOKIE["user"].' !<span class="sr-only">(current)</span></a></li>' : '<li><a href="../navbar/">Default</a></li>';
                ?>


            </ul>
        </div>
    </div><!--/.nav-collapse -->



</div>
</div>
<div class="bg">
    <div class="container">
        <div class="starter-template">