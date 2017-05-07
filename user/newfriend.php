<?php
require_once '../vendor/load-class.php';
    if(isset($_POST['accept'])) \User\User::acceptFriend($_POST['accept']);
    if(isset($_POST['delete'])) \User\User::ignoreFriend($_POST['delete']);

    if (isset($_POST['sendFriend'])) \User\User::sendFriend($_POST['sendFriend']); //zapraszanie poprzez showSearchFriend
    if (isset($_POST['send'])) \User\User::sendFriend($_POST['send']);
    if (isset($_POST['accept'])) \User\User::acceptFriend($_POST['accept']);
    if (isset($_POST['unfriend'])) \User\User::deleteFriend($_POST['unfriend']);
    if (isset($_POST['ignore'])) \User\User::ignoreFriend($_POST['ignore']);
    if (isset($_POST['cancel'])) \User\User::cancelFriend($_POST['cancel']);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/newfriend-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>