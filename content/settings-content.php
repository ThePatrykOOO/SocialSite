<div class="jumbotron col-lg-6">
    <h2 class="center-text">Ustawienia</h2><br>
    <?php
        if (isset($_SESSION['success'])) {
            \User\Success::successShow($_SESSION['success']);
            unset($_SESSION['success']);
        }
    ?>
    <form method="post">
        <table class="edit-profil">
            <tr>
                <td>
                    Imię:
                </td>
                <td>
                    <input type="text" class="form-control" disabled="disabled" value="IMIE">
                </td>
            </tr>
            <tr>
                <td>
                    Nazwisko:
                </td>
                <td>
                    <input type="text" class="form-control" disabled="disabled" value="NAZWISKO">
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="email" class="form-control" disabled="disabled" value="EMAIL">
                </td>
            </tr>
            <tr>
                <td>
                    Data Urodzenia:
                </td>
                <td>
                    <input type="date" class="form-control" name="birth" value="2000-01-02">
                </td>
            </tr>
            <tr>
                <td>
                    Miejsce Zamieszkania:
                </td>
                <td>
                    <input type="text" class="form-control" name="home" value="HOME">
                </td>
            </tr>
            <tr>
                <td>
                    Praca:
                </td>
                <td>
                    <input type="text" class="form-control" name="work" value="WORK">
                </td>
            </tr>
            <tr>
                <td>
                    Szkoła:
                </td>
                <td>
                    <input type="text" class="form-control" name="school" value="SCHOOL">
                </td>
            </tr>
            <tr>
                <td>
                    Telefon:
                </td>
                <td>
                    <input type="tel" class="form-control" name="phone" value="3232">
                </td>
            </tr>
            <tr>
                <td>
                    O mnie:
                </td>
                <td>
                    <textarea name="about" class="form-control">COŚ</textarea>
                </td>
            </tr>
            <br>
            <tr>
                <td></td>
                <td>
                    <br><input type="submit" class="btn btn-danger" value="Zapisz">
                </td>
            </tr>
        </table>
    </form>
    <h3>Zmiana Hasła:</h3>
    <form method="post">
        <div class="form-group">
            <label>Obecne hasło:</label>
            <input type="password" class="form-control" name="oldPassword" placeholder="obecne hasło">
        </div>
        <div class="form-group">
            <label>Nowe Hasło:</label>
            <input type="password" class="form-control" name="newPassword1" placeholder="nowe hasło">
        </div>
        <div class="form-group">
            <label>Powtórz nowe Hasło:</label>
            <input type="password" class="form-control" name="newPassword2" placeholder="powtórz nowe hasło">
        </div>
        <button type="submit" class="btn btn-success">Zmień Hasło</button>
    </form>
    <h3 class="center-text">Moje strony</h3>
    <table class="edit-profil">
        <tr>
            <td>
                Nazwa strony:
            </td>
            <td>
                <i class="fa fa-trash-o" title="Usuń Stronę"></i>
            </td>
            <td>
                <i class="fa fa-cog" title="Edytuj Stronę"></i>
            </td>
        </tr>
        <tr>
            <td>
                Nazwa strony:
            </td>
            <td>
                <i class="fa fa-trash-o" title="Usuń Stronę"></i>
            </td>
            <td>
                <i class="fa fa-cog" title="Edytuj Stronę"></i>
            </td>
        </tr>
    </table>
    <h3 class="center-text">Moje Grupy</h3>
    <table class="edit-profil">
        <tr>
            <td>
                Nazwa Grupy:
            </td>
            <td>
                <i class="fa fa-trash-o" title="Usuń Grupę"></i>
            </td>
            <td>
                <i class="fa fa-cog" title="Edytuj Grupę"></i>
            </td>
        </tr>
    </table>
    <h3 class="center-text">Grupy do których należę</h3>
    <table class="edit-profil">
        <tr>
            <td>
                Nazwa Grupy:
            </td>
            <td>
                <i class="fa fa-times-circle" title="Wyjdź"></i>
            </td>
        </tr>
    </table>

</div>