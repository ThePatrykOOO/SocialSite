<?php
require_once '../vendor/load-class.php';

    $sql = "SELECT * FROM users WHERE id=:id";
    $question = \Connect\Connect::connect()->prepare($sql);
    $question->bindValue(':id',$_SESSION['iduser'], PDO::PARAM_STR);
    $question->execute();
    $result = $question->fetch();
    $name = $result['name'];
    $surname = $result['surname'];
    $email = $result['email'];
    $birth = $result['birth'];
    $home = $result['home'];
    $school = $result['school'];
    $work = $result['work'];
    $about = $result['about'];
    $phone = $result['phone'];

    if (isset($_POST['postText'])) \User\User::addPost($typeAutor=1,$_POST['postText']);
    if(isset($_POST['like'])) \User\User::likePost($_POST['like']);
    if(isset($_POST['alreadyUnlike'])) \User\User::alreadyUnlike($_POST['alreadyUnlike']);
    if(isset($_POST['unlike'])) \User\User::unLikePost($_POST['unlike']);
    if(isset($_POST['alreadyLike'])) \User\User::alreadyLike($_POST['alreadyLike']);

?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/myprofil-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>
