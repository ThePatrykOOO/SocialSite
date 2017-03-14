<!DOCTYPE html>
<html>
<head>
	<title>Social Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

</head>
<body>
  <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Social Page</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          	<li data-toggle="tooltip" title="Strona Główna">
              <a href="#"><b class="fa a-home"></b></a>
            </li>
            <li data-toggle="tooltip" title="Profil">
              <a href="#"><b class="fa fa-user-o"></b></a>
            </li>
            <li data-toggle="tooltip" title="Wiadomości">
              <a class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-commenting-o"></b></a>
              <ul class="dropdown-menu">
                <h5><small>Wiadomości</small></h5>
                <li class="messageTop">
                  <a href="#">Patryk Filipiak</a>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation</p>
                </li>
              </ul>
            </li> 
            <li data-toggle="tooltip" title="Zaproszenia">
              <a class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user-plus"></b></a>
              <ul class="dropdown-menu">
                <h5><small>Zaproszenia</small></h5>
                <li class="dropAdd">
                  <a href="#">Patryk Filipiak</a>
                  <button type="button" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                  <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></button>
                </li>
              </ul>
            </li>
            <li class="dropdown" data-toggle="tooltip" title="Opcje">
              <a class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-cog"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Utwórz Stronę</a></li>
                <li><a href="#">Utwórz Grupę</a></li>
                <li><a href="#">Ustawienia</a></li>
                <li><a href="#">Wyloguj się</a></li>
              </ul>
            </li>
            <li data-toggle="tooltip" title="Wyloguj Się">
              <a href="#"><b class="fa fa-sign-in"></b></a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<div class="jumbotron col-lg-3">
      <h4 class="center-text">Panel</h4>
      <div class="yourProfil">
        <i class="fa fa-male"></i>
        <span class="profilLink">Patryk Filipiak</span>        
        <div class="dropdown dropButton">
          <button type="button" data-toggle="dropdown" class="dropdownBlank"><i class="fa fa-ellipsis-v"></i></button>
          <ul class="dropdown-menu">
            <li><a href="#">Edytuj Profil</a></li>
          </ul>
        </div>
      </div>
      <ul class="list-group">
        <li class="list-group-item"><b>Moje Strony</b>
        <li class="list-group-item"><b>Moje Grupy</b></li>
        <li class="list-group-item">Zapisane</li>
        <li class="list-group-item"><i class="fa fa-gamepad"></i>Gry</li>
        <li class="list-group-item"><i class="fa fa-cogs"></i>Ustawienia</li>
      </ul>
    </div> <!-- Panel -->
    <div class="jumbotron col-lg-6">
      <div class="col-lg-12">
      <h2 class="center-text">Posty</h2><br>
        <form>
          <div class="form-group">
          <label for="exampleTextarea">Dodaj Post</label>
          <textarea class="form-control" id="exampleTextarea" placeholder="Wpisz o czym teraz myślisz..." name="newPostAdd"></textarea><br>
          <button type="submit" class="btn btn-primary">Dodaj Post</button>
        </div>
        </form>
      </div>
      <div class="col-lg-12">
        <h4>Patryk Filipiak<small>13.03.2017</small></h4>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        <div class="optionsPost">
          <button type="button" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i>Polub</button>
          <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i>Nie lubię</button>
          <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-comment"></i>Komentarz</button>
          <button type="button" class="btn btn-info btn-xs"><i class="fa fa-hand-paper-o"></i>Zgłoś</button>
          <!-- <div class="commentSection">
            <span>Patryk Filipiak</span>
            <span><data>19.01.2020</data></span>
            <p>Lorem ipsum dolor sit amet</p>
            <button type="button" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i>Polub</button>
          </div>  --><!-- comentSection -->
        </div>
      </div>
    </ul>
    </div><!-- Posts -->
    <div class="jumbotron col-lg-3">
      <h4 class="center-text">Czat</h4>
      <ul class="list-group">
      <li class="list-group-item">Jan Kowalski</li>
      <li class="list-group-item">Jan Kowalski</li>
      <li class="list-group-item">Jan Kowalski</li>
      <li class="list-group-item">Jan Kowalski</li>
    </ul>
    </div> <!-- Czat -->


    </div><!-- /.container -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/comment.js"></script>
</body>
</html>