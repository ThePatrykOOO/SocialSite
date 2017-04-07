<?php
    include "../php/user.php";
    if (isset($_POST['urlSaved'])) {
        \User\User::addSave($_POST['savedName'], $_POST['urlSaved']);
    }
    if (isset($_GET['del'])) {
        $id = isset($_GET['del']) ? intval($_GET['del']) : 0;
        if ($id != 0)
            \User\User::deleteSaved($id);
    }


?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/saved-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>