<?php
session_start();
    require '../php/user.php';
    use \User\User as User;
    if(isset($_POST['birth'])) {
        User::editProfil($_POST['birth'],$_POST['home'],$_POST['work'],$_POST['school'],$_POST['phone'],$_POST['about']);
    }
    if(isset($_POST['oldPassword'])) {
        User::changePass($_POST['oldPassword'],$_POST['newPassword1'],$_POST['newPassword2']);
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
<?php include '../content/profil-edit-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>

