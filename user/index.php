<?php
    require '../vendor/autoload.php';
    if (isset($_POST['postText'])) \User\User::addPost($typeAutor=1,$_POST['postText']);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/posts.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>
