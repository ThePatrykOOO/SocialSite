<?php
include '../php/user.php';
use User\User as User;
    if(isset($_POST['birth'])) {
        User::editProfil($_POST['birth'],$_POST['home'],$_POST['work'],$_POST['school'],$_POST['phone'],$_POST['about']);
    }
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../includes/profil-edit-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>

