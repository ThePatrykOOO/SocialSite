<?php
require '../vendor/autoload.php';
    if(isset($_POST['accept'])) \User\User::acceptFriend($_POST['accept']);
    if(isset($_POST['delete'])) \User\User::ignoreFriend($_POST['delete']);

    if (isset($_POST['sendFriend'])) \User\User::sendFriend($_POST['sendFriend']); //zapraszanie poprzez showSearchFriend
    if (isset($_POST['send'])) \User\User::sendFriend($id);
    if (isset($_POST['accept'])) \User\User::acceptFriend($id);
    if (isset($_POST['unfriend'])) \User\User::deleteFriend($id);
    if (isset($_POST['ignore'])) \User\User::ignoreFriend($id);
    if (isset($_POST['cancel'])) \User\User::cancelFriend($id);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/newfriend-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>