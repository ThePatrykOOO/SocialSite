<div class="jumbotron col-lg-6 col-md-6">
    <h2 class="center-text">Edytuj Stronę</h2><br>
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
    <form method="post">
        <table class="edit-profil">
            <tr>
                <td>
                    Nazwa:
                </td>
                <td>
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Opis:
                </td>
                <td>
                    <input type="text" class="form-control" name="description" value="<?php echo $description ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Rodzaj Strony:
                </td>
                <td>
                    <select name="typeSite" class="form-control">
                        <option value="null">---</option>
                        <?php
                            \User\Page::showTypeSite();
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <br><input type="submit" class="btn btn-danger" value="Zapisz">
                </td>
            </tr>
        </table>
    </form>
</div>