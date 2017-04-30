<div class="jumbotron col-lg-6 col-md-6">
    <h3 class="center-text">Moje Grupy</h3>
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