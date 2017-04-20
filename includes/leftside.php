<div class="jumbotron col-lg-3 col-md-3" id="leftside" >
  <h4 class="center-text">Panel</h4>
  <div class="yourProfil">
    <i class="fa fa-male"></i>
    <span class="profilLink"><?php echo $_SESSION['fullName']; ?></span>        
    <div class="dropdown dropButton">
      <button type="button" data-toggle="dropdown" class="dropdownBlank"><i class="fa fa-ellipsis-v"></i></button>
      <ul class="dropdown-menu">
        <li><a href="ustawienia">Edytuj Profil</a></li>
      </ul>
    </div>
  </div>
  <ul class="list-group">
    <li class="list-group-item"><a href="moje-strony">Moje Strony</a></li>
    <li class="list-group-item"><a href="moje-grupy">Moje Grupy</a></li>
    <li class="list-group-item"><a href="zapisane">Zapisane</a></li>
    <li class="list-group-item"><i class="fa fa-gamepad"></i> Gry</li>
    <li class="list-group-item"><i class="fa fa-cogs"></i> <a href="ustawienia">Ustawienia</a></li>
  </ul>
</div> <!-- Panel -->
<button type="button" class="btn btn-default panelIcon" id="panelIcon"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i></button>