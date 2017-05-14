<?php
require_once '../vendor/load-class.php';
if(isset($_POST['like'])) \User\User::likePost($_POST['like']);
if(isset($_POST['alreadyUnlike'])) \User\User::alreadyUnlike($_POST['alreadyUnlike']);
if(isset($_POST['unlike'])) \User\User::unLikePost($_POST['unlike']);
if(isset($_POST['alreadyLike'])) \User\User::alreadyLike($_POST['alreadyLike']);
if (isset($_POST['postText'])) \User\User::addPost($typeAutor=1,$_POST['postText']);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/posts.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>
