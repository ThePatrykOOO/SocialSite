<div class="jumbotron col-lg-6">
    <h2 class="center-text">Utwórz Stronę</h2>
    <p>Tutaj możesz utworzyć swoją stronę.</p>
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
                <option value="0">Firma</option>
                <option value="1">Organizacja</option>
                <option value="2">Marka</option>
                <option value="3">Produkt</option>
                <option value="4">Artysta</option>
                <option value="5">Zespół</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Stwórz">
        </div>
    </form>
</div>