<div class="jumbotron col-lg-6 col-md-6">
    <h2 class="center-text">Utwórz Grupę</h2>
    <p>Tutaj możesz utworzyć swoją grupę.</p>
    <?php
    if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
        \Error\Error::showErrors($_SESSION['errorUser']);
        unset($_SESSION['errorUser']);
    }
    if (isset($_SESSION['success'])) {
        \User\Success::successShow($_SESSION['success']);
        unset($_SESSION['success']);
    }
    ?>
    <form method="post" autocomplete="on">
        <div class="form-group">
            <label>Nazwa Grupy:</label>
            <input type="text" class="form-control" name="nameGroup" placeholder="Podaj nazwę strony" >
        </div>
        <div class="form-group">
            <label>Status Grupy:</label><br>
            <input type="radio" name="statusGroup" value="Publiczna" >Publiczna<br>
            <input type="radio" name="statusGroup" value="Niepubliczna" >Niepubliczna<br>
            <input type="radio" name="statusGroup" value="Prywatna" >Prywatna<br>
        </div>
        <div class="form-group">
            <label>Dodaj Znajomych:</label>
            <div class="alert alert-warning" style="overflow: scroll">
                <?php \User\Page::showFriendGroup(); ?>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Stwórz">
        </div>
    </form>
</div>