<div class="jumbotron col-lg-6 col-md-6">
    <div class="col-lg-12">
    <h2><?php echo $name; ?>
        <?php
            if($admin == $_SESSION['iduser'])
                echo '<a href="edytuj-strone?id=2" class="dropdown-toggle" title="Edytuj Stronę"><i class="fa fa-cog"></i></a>';
        ?>
    </h2>
    <table class="table table-bordered">
        <tbody><tr>
            <td><b>Nazwa</b></td>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <td><b>Opis</b></td>
            <td><?php echo $descrtiption; ?></td>
        </tr>
        <tr>
            <td><b>Kategoria</b></td>
            <td><?php echo $type; ?></td>
        </tr>
        <tr>
            <td><b>Polubienia</b></td>
            <td id="likeStatus"><!--        --><?php //\User\User::likeSiteStatus($id) ?></td>
        </tr>

        </tbody>
    </table>
        <h2 class="center-text">Posty</h2><br>
            <?php
            if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
                \Error\Error::showErrors($_SESSION['errorUser']);
                unset($_SESSION['errorUser']);
            }
            ?>

        <?php
            if ($admin == $_SESSION['iduser']) {
                echo '<form method="post">
            <div class="form-group">
                <label for="exampleTextarea">Dodaj Post</label>

                <textarea class="form-control" name="postText" placeholder="Wpisz o czym teraz myślisz..." name="newPostAdd"></textarea><br>
                <button type="submit" class="btn btn-primary">Dodaj Post</button>
            </div>
        </form>';
            }
            ?>
    </div>
    <div id="posts">
        <?php
            \User\User::showPagePost($id);
        ?>
    </div><!-- Posts -->
</div>