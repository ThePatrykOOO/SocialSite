<div class="jumbotron col-lg-6 col-md-6">
    <h3 class="center-text">Zapisane</h3>
    <?php
        if (isset($_SESSION['success'])) {
            \User\Success::successShow($_SESSION['success']);
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
            \Error\Error::showErrors($_SESSION['errorUser']);
            unset($_SESSION['errorUser']);
        }
    ?>
    <form method="post" autocomplete="on">
        <div class="form-group">
            <label>Nazwa strony</label>
            <input type="text" class="form-control" name="savedName" placeholder="Nazwa Strony do zapisania">
        </div>
        <div class="form-group">
            <label>Url Strony:</label>
            <input type="url" class="form-control" name="urlSaved" placeholder="wpisz url strony">
        </div>
        <button type="submit" class="btn btn-success">Zapisz</button>
    </form>
    <h3 class="center-text">Rzeczy ostatnio zapisane</h3>
    <table class="edit-profil">
        <?php
            \User\User::showSaved();
        ?>
    </table>
</div>