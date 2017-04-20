<div class="jumbotron col-lg-6 col-md-6">
    <div class="col-lg-12">
        <h2>
            <?php echo $nameGroup;
            if ($admin == $_SESSION['iduser']) {
            echo ' <a href="edytuj-grupe?id='.$id.'" class="dropdown-toggle" title="Edytuj Grupę"><i class="fa fa-cog"></i></a> ';

                echo ' <a href="dodaj-uzytkownikow?id='.$id.'" title="Dodaj członków"><icon class="fa fa-user-plus"></icon></a>';
            }
        ?>
        </h2>
        <table class="table table-bordered">
            <tbody><tr>
                <td><b>Admin:</b></td>
                <td><?php echo '<a href="profile?id='.$admin.'">'.$fullname.'</a>'; ?></td>
            </tr>
            <tr>
                <td><b>Status Grupy</b></td>
                <td><?php echo \User\User::showStatusGroup($status); ?></td>
            </tr>
            <tr>
                <td><b>Ilość członków</b></td>
                <td><?php echo \User\User::showCountMembersGroup($id); ?></td>
            </tr>
            </tbody>
        </table>
        <h2 class="center-text">Posty</h2><br>
        <form method="post">
            <div class="form-group">
                <label for="exampleTextarea">Dodaj Post</label>
                <?php
                    if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
                        \Error\Error::showErrors($_SESSION['errorUser']);
                        unset($_SESSION['errorUser']);
                    }
                ?>
                <textarea class="form-control" name="postText" placeholder="Wpisz o czym teraz myślisz..." name="newPostAdd"></textarea><br>
                <button type="submit" class="btn btn-primary">Dodaj Post</button>
            </div>
        </form>
    </div>
    <div id="posts">
        <?php \User\User::showGroupPost($id); ?>
    </div><!-- Posts -->
</div>