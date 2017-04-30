<?php
require_once '../vendor/load-class.php';
    if (isset($_POST['deleteGroup'])) \User\User::deleteGroup($_POST['deleteGroup']);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/mygroups-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>