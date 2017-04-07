<?php
  include 'php/signup.php';
  include 'php/user.php';
  use SignUp\SignUp as SignUp;
  use User\User as User;
  use Error\Error as Error;
  if (isset($_POST['first'])) {
      SignUp::register($_POST['first'], $_POST['last'], $_POST['birth'], $_POST['email'], $_POST['password']);
  }
  if (isset($_POST['emailLogin'])) {
      User::login($_POST['emailLogin'], $_POST['passwordLogin']);
  }
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
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/hello.css" rel="stylesheet">

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
          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Social Site</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#home">Home</a></li>
                  <li><a href="#login">Zaloguj</a></li>
                  <li><a href="#restiger">Rejestracja</a></li>
                  <li><a href="#about">O nas</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover home">
            <h1 class="cover-heading" id="home">Home</h1>
            <p class="lead">Zarejestruj się w naszym serwisie. Poznaj wielu ciekawych ludzi. Dziel się swoimi zdjęciami, publikuj posty na grupach lub twórz własne strony.</p>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading" id="login">Zaloguj Się</h1>
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

          <div class="inner cover">
            <h1 class="cover-heading" id="restiger">Zarejestruj Się</h1>
            <?php
              if (isset($_SESSION['errorRegister']) && count($_SESSION['errorRegister']) > 0) {
                  Error::showErrorsRegister($_SESSION['errorRegister']);
                unset($_SESSION['errorRegister']);
              }
            ?>
          </div>
            <form method="POST" autocomplete="autocomplete">
              <div class="form-group">
                <label for="exampleInputEmail1">Imię</label>
                <input type="text" class="form-control" name="first" required placeholder="Podaj Imię" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nazwisko</label>
                <input type="text" class="form-control" name="last" required placeholder="Podaj Nazwisko">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Data urodzin</label>
                <input type="date" class="form-control" name="birth" required min="1920-01-01" max="2010-12-31" placeholder="Podaj Datę Urodzin">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Adres Email</label>
                <input type="email" class="form-control" name="email" required placeholder="Adres Email">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Hasło</label>
                <input type="password" class="form-control" name="password" required placeholder="Podaj Hasło">
              </div>
              <button type="submit" class="btn btn-success">Zarejestruj Się</button>
            </form>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading" id="about">O nas</h1>
            <p class="lead">Strona jest realizowana w ramach konkursu Daj Się Poznać 2017</p>
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
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
