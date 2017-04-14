<div class="jumbotron col-lg-6">
    <h4>Czat: <?php echo $fullname ?></h4>
    <div class="messenger">
        <?php
        \User\User::showMessages($id);
        ?>
    </div>




    <form method="post">
        <div class="form-group">
            <?php
            if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
                Error\Error::showErrors($_SESSION['errorUser']);
                unset($_SESSION['errorUser']);
            }
            ?>
            <textarea class="form-control " rows="2" name="message" placeholder="Napisz Wiadomość"></textarea>
        </div>
        <button type="submit" class="btn btn-success btn-block">Wyślij</button>
    </form>
</div>