<?php
    require '../vendor/autoload.php';
    if (isset($_POST['postText'])) \User\User::addPost($typeAutor=1,$_POST['postText']);
    if(isset($_POST['like'])) \User\User::likePost($_POST['like']);
    if(isset($_POST['alreadyUnlike'])) \User\User::alreadyUnlike($_POST['alreadyUnlike']);
    if(isset($_POST['unlike'])) \User\User::unLikePost($_POST['unlike']);
    if(isset($_POST['alreadyLike'])) \User\User::alreadyLike($_POST['alreadyLike']);
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if ($id == 0) header("Location: main");
    if (isset($_POST['commentText'])) \User\User::addComment($_POST['commentText'],$id);
    $GLOBALS['seemore'] = true;

?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/post-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>
