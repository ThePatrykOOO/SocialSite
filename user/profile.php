<?php
require '../vendor/autoload.php';
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if ($id == 0 ) header("Location: moj-profil");
    $question = \Connect\Connect::connect()->prepare("SELECT * FROM users WHERE id=:id");
    $question->bindValue(':id', $id, PDO::PARAM_INT);
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

    if (isset($_POST['send'])) \User\User::sendFriend($id);
    if (isset($_POST['accept'])) \User\User::acceptFriend($id);
    if (isset($_POST['unfriend'])) \User\User::deleteFriend($id);
    if (isset($_POST['ignore'])) \User\User::ignoreFriend($id);
    if (isset($_POST['cancel'])) \User\User::cancelFriend($id);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/profile-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>
