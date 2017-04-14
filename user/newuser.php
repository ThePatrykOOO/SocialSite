<?php
require '../vendor/autoload.php';
use User\User as User;
use Error\Error as Error;
if (isset($_POST['emailLogin'])) {
    User::login($_POST['emailLogin'], $_POST['passwordLogin']);
}
if(isset($_SESSION['newUser'])) unset($_SESSION['newUser']); else header("Location: ../index.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Social Site">
    <meta name="author" content="Patryk Filipiak">
    <title>Social Site Start - Załóż bezpłatne konto</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/hello.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="cover-container">
            <div class="inner">
                <h1 class="text-center">Social Site</h1>
            </div>

            <div>
                <h3 class="cover-heading" id="home">Udana Rejestracja</h3>
                <p>Udało ci się zarejestrować w naszym serwisie. Teraz możesz się już zalogować.</p>
            </div>
            <div class="inner cover">
                <h2 class="text-center">Zaloguj Się</h2>
                <?php
                if (isset($_SESSION['errorLogin']) && count($_SESSION['errorLogin']) > 0) {
                    Error::showErrorsLogin($_SESSION['errorLogin']);
                    unset($_SESSION['errorLogin']);
                }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adres Email</label>
                        <input type="email" class="form-control" name="emailLogin" placeholder="Adres Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hasło</label>
                        <input type="password" class="form-control" name="passwordLogin" placeholder="Podaj Hasło">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">Zapamiętaj mnie
                        </label>
                    </div>
                    <button type="submit" class="btn btn-danger">Zaloguj Się</button>
                </form>
            </div>
            <div class="mastfoot">
                <div class="inner">
                    <p>Twórca <a href="http://patrykfilipiak.pl">Patryk Filipiak</a> Daj Się Poznać 2017</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>