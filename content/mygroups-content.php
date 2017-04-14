<div class="jumbotron col-lg-6">
    <h3 class="center-text">Moje Grupy</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nazwa</th>
            <th>Usuń</th>
            <th>Ustawienia</th>
        </tr>
        </thead>
        <tbody>
        <?php \User\User::showMyGroup();?>
        </tbody>
    </table>
</div>