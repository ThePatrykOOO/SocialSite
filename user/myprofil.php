<?php
require '../vendor/autoload.php';

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
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/myprofil-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>
