<?php
    require '../vendor/autoload.php';
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if (isset($_POST['FriendGroup'])) \User\User::addUserGroup($_POST['FriendGroup'],$id);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/add-members-group-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>