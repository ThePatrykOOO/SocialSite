<div class="jumbotron col-lg-6 col-md-6">
<h3>Członkowie Grupy:</h3>
    <?php
    if (isset($_SESSION['success'])) {
        \User\Success::successShow($_SESSION['success']);
        unset($_SESSION['success']);
    }
    \User\User::showMembersGroup($id);
    ?>
</div>