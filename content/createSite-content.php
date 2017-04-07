<div class="jumbotron col-lg-6">
    <h2 class="center-text">Utwórz Stronę</h2>
    <p class="center-text">Tutaj możesz utworzyć swoją stronę.</p>
    <?php
        if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
            \Error\Error::showErrorsUser($_SESSION['errorUser']);
            unset($_SESSION['errorUser']);
        }
    ?>
    <form method="post">
        <div class="form-group">
            <label>Nazwa Strony:</label>
            <input type="text" class="form-control" name="nameSite" placeholder="Podaj nazwę strony">
        </div>
        <div class="form-group">
            <label>Opis strony:</label>
            <input type="text" class="form-control" name="describeSite" placeholder="Podaj opis strony">
        </div>
        <div class="form-group">
            <label>Rodzaj strony:</label>
            <select name="typeSite" class="form-control">
<!--               Wypiszemy tutaj rekordy z bazy danych-->
                <option value="null">---</option>
                <?php
                    \User\Page::showTypeSite();
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Stwórz">
        </div>
    </form>
</div>