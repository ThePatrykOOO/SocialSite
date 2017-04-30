<?php
require_once '../vendor/load-class.php';
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if ($id == 0 ) header("Location: main");
    $sql = "SELECT u.id, u.name, u.surname, g.nameGroup, g.status FROM groups as g, users as u WHERE u.id=g.admin AND g.id=:id";
    $question = \Connect\Connect::connect()->prepare($sql);
    $question->bindValue(':id', $id, PDO::PARAM_INT);
    $question->execute();
    $result = $question->fetch();
    $admin = $result['id'];
    $fullname = $result['name']." ".$result['surname'];
    $nameGroup = $result['nameGroup'];
    $status = $result['status'];

    if (isset($_POST['postText'])) \User\User::addPost($typeAutor=3,$_POST['postText'],$id);
    if(isset($_POST['like'])) \User\User::likePost($_POST['like']);
    if(isset($_POST['alreadyUnlike'])) \User\User::alreadyUnlike($_POST['alreadyUnlike']);
    if(isset($_POST['unlike'])) \User\User::unLikePost($_POST['unlike']);
    if(isset($_POST['alreadyLike'])) \User\User::alreadyLike($_POST['alreadyLike']);

?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/group-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>