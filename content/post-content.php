<div class="jumbotron col-lg-6 col-md-6">
    <?php \User\User::showPost($id); ?>

    <h4 class="center-text">Dodaj Komentarz</h4>
    <form method="post">
        <?php
        if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
            \Error\Error::showErrors($_SESSION['errorUser']);
            unset($_SESSION['errorUser']);
        }
        ?>
        <div class="form-group">
            <textarea class="form-control" name="commentText" placeholder="Wpisz tutaj komenarz."></textarea><br>
            <button type="submit" class="btn btn-primary right">Dodaj Komentarz</button>
        </div>
    </form>
    <?php \User\User::showComment($id);?>
</div>