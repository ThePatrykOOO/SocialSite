<div class="jumbotron col-lg-6">
    <h2 class="center-text">Utwórz Grupę</h2>
    <p>Tutaj możesz utworzyć swoją grupę.</p>
    <form method="post">
        <div class="form-group">
            <label>Nazwa Grupy:</label>
            <input type="text" class="form-control" name="nameGroup" placeholder="Podaj nazwę strony">
        </div>
        <div class="form-group">
            <label>Dodaj Znajomych:</label>
            <select name="typeSite" class="form-control" multiple size="10">
                <!--Znajomi-->
                <option value="0">Jan Kowalski</option>
                <option value="1">Janina Kowalska</option>
                <option value="2">Marek Nowak</option>
            </select>
            <p>Przytrzymaj Ctrl lub Shift aby wybrać większą ilość osób.</p>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Stwórz">
        </div>
    </form>
</div>