<?php
    require '../vendor/autoload.php';
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if(isset($_POST['name'])) {
        \User\User::editsite($_POST['name'],$_POST['description'],$_POST['typeSite'],$id);
    }

    $sql = "SELECT s.name, s.description, t.name_type FROM sites as s, type_site as t WHERE admin=:iduser AND idsite=:idSite AND t.id = s.type";
    $question = \Connect\Connect::connect()->prepare($sql);
    $question->bindValue(':iduser', $_SESSION['iduser'], PDO::PARAM_INT);
    $question->bindValue(':idSite', $id, PDO::PARAM_INT);
    $question->execute();
    if($question->rowCount()==0) header("Location: main");
    $result = $question->fetch();
    $name = $result['name'];
    $description = $result['description'];
    $type = $result['name_type'];
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/site-edit-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>