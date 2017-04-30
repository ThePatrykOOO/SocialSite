<?php
require_once '../vendor/load-class.php';
    if (isset($_POST['urlSaved'])) \User\User::addSave($_POST['savedName'], $_POST['urlSaved']);
    if (isset($_POST['delete'])) \User\User::deleteSaved($_POST['delete']);


?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/saved-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>