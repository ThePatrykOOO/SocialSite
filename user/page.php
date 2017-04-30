<?php
require_once '../vendor/load-class.php';
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if ($id == 0 ) header("Location: main");
    $sql = "SELECT s.name, s.description, s.admin, t.name_type FROM sites as s, type_site as t WHERE idsite=:id AND s.idsite=t.id";
    $question = \Connect\Connect::connect()->prepare($sql);
    $question->bindValue(':id', $id, PDO::PARAM_INT);
    $question->execute();
    $result = $question->fetch();
    $name = $result['name'];
    $admin = $result['admin'];
    $descrtiption = $result['description'];
    $type = $result['name_type'];

//    if (isset($_POST['UnlikeSite'])) \User\User::unlikeSite($_POST['UnlikeSite']);
//    if (isset($_POST['likeSite'])) \User\User::likeSite($_POST['likeSite']);

    if (isset($_POST['postText'])) \User\User::addPost($typeAutor=2,$_POST['postText'],$id);

?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/page-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>