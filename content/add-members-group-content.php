<div class="jumbotron col-lg-6 col-md-6">
    <h3>Dodaj członków do grupy</h3>
    <form method="post">
        <?php
        \User\Page::showFriendGroup($id);
        ?>
        <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Dodaj Użytkowników">
        </div>
    </form>
</div>