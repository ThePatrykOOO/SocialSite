<?php
require_once '../vendor/load-class.php';
    if(isset($_POST['birth'])) {
        \User\User::editProfil($_POST['birth'],$_POST['home'],$_POST['work'],$_POST['school'],$_POST['phone'],$_POST['about']);
    }
    if(isset($_POST['oldPassword'])) {
        \User\User::changePass($_POST['oldPassword'],$_POST['newPassword1'],$_POST['newPassword2']);
    }
    $question = \Connect\Connect::connect()->prepare("SELECT * FROM users WHERE id=:iduser");
    $question->bindValue(':iduser', $_SESSION['iduser'], PDO::PARAM_INT);
    $question->execute();
    $result = $question->fetch();
    $name = $result['name'];
    $surname = $result['surname'];
    $email = $result['email'];
    $birth = $result['birth'];
    $home = $result['home'];
    $work = $result['work'];
    $school = $result['school'];
    $birth = $result['birth'];
    $phone = $result['phone'];
    $about = $result['about'];

?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/settings-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>