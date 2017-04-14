<?php
require '../vendor/autoload.php';
    if(isset($_POST['accept'])) \User\User::acceptFriend($_POST['accept']);
    if(isset($_POST['delete'])) \User\User::ignoreFriend($_POST['delete']);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/newfriend-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>