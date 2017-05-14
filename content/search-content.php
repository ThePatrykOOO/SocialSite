<div class="jumbotron col-lg-6 col-md-6">
    <div class="col-lg-12">
        <h4 class="center-text">Wyszukiwarka</h4><br>
        <?php if (isset($_POST['search-navbar'])) \User\User::searchNavbar($_POST['search-navbar']);?>
    </div>
</div>