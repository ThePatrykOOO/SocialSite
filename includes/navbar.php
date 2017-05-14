<body>
<div class="container main-content">
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="main">Social Site</a>

        <form class="navbar-form search-form col-md-6 col-sm-3" role="search" method="post" action="szukaj">
            <div class="input-group col-md-12">
                <input type="text" class="form-control" name="search-navbar" placeholder="Szukaj...">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
        	<li data-toggle="tooltip" title="Strona Główna">
            <a href="main"><b class="fa a-home"></b></a>
          </li>
          <li data-toggle="tooltip" title="Profil">
            <a href="moj-profil"><b class="fa fa-user-o"></b></a>
          </li>
          <li data-toggle="tooltip" title="Wiadomości">
            <a href="messages"><b class="fa fa-commenting-o"></b></a>
          </li> 
          <li data-toggle="tooltip" title="Zaproszenia">
            <a class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-user-plus"></b></a>
            <ul class="dropdown-menu">
              <h5><small><a href="zaproszenia">Zaproszenia</a></small></h5>
              <?php \User\User::yourRequestFriend(); ?>
            </ul>
          </li>
          <li class="dropdown" data-toggle="tooltip" title="Opcje">
            <a class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-cog"></b></a>
            <ul class="dropdown-menu">
              <li><a href="stworz-strone">Utwórz Stronę</a></li>
              <li><a href="stworz-grupe">Utwórz Grupę</a></li>
              <li><a href="ustawienia">Ustawienia</a></li>
              <li><a href="../php/logout.php">Wyloguj się</a></li>
            </ul>
          </li>
          <li data-toggle="tooltip" title="Wyloguj Się">
            <a href="../php/logout.php"><b class="fa fa-sign-in"></b></a>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>