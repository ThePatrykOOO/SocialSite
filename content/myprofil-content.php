<div class="jumbotron col-lg-6 col-md-6">
    <h2>Twój Profil
        <a href="edytuj-profil" class="dropdown-toggle" title="Edytuj Profil"><i class="fa fa-cog"></i></a>
    </h2>
    <table class="table table-bordered">
        <tr>
            <td><b>Imie:</b></td>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <td><b>Nazwisko</b></td>
            <td><?php echo $surname; ?></td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td><?php echo $email; ?></td>
        </tr>
    </table>
    <button type="button" id="more-profil" class="btn btn-primary">Więcej »</button>
    <table class="table table-bordered" id="profil-hide">
        <tr>
            <td><b>Data urodzenia</b></td>
            <td><?php echo $birth; ?></td>
        </tr>
        <tr>
            <td><b>Miejsce Zamieszkania</b></td>
            <td><?php echo $home; ?></td>
        </tr>
        <tr>
            <td><b>Praca</b></td>
            <td><?php echo $work; ?></td>
        </tr>
        <tr>
            <td><b>Telefon</b></td>
            <td><?php echo $phone; ?></td>
        </tr>
        <tr>
            <td><b>O mnie</b></td>
            <td><?php echo $about; ?></td>
        </tr>
    </table>

    <h2 class="center-text">Znajomi</h2><br>
    <div class="col-lg-12">
        <h2 class="center-text">Wszystkie Moje Posty</h2><br>
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
        <?php \User\User::showMyPost(); ?>
    </ul>
</div><!-- Posts -->