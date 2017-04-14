<?php
    require '../vendor/autoload.php';
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

?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/group-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>