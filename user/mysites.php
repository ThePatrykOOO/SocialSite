<?php
require_once '../vendor/load-class.php';
    if (isset($_POST['deleteSites'])) \User\User::deleteSite($_POST['deleteSites']);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/mysites-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>