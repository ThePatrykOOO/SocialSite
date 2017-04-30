<?php
require_once '../vendor/load-class.php';
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if(isset($_POST['name'])) {
        if (isset($_POST['statusGroup']))
            $statusGroup = $_POST['statusGroup'];
        else
            $statusGroup = null;
        \User\User::editGroup($_POST['name'],$statusGroup,$id);
    }

    $sql = "SELECT nameGroup, status FROM groups WHERE id=:id AND admin=:iduser";
    $question = \Connect\Connect::connect()->prepare($sql);
    $question->bindValue(':id', $id, PDO::PARAM_INT);
    $question->bindValue(':iduser', $_SESSION['iduser'], PDO::PARAM_INT);
    $question->execute();
    if($question->rowCount()==0) header("Location: main");
    $result = $question->fetch();
    $name = $result['nameGroup'];
    $status = $result['status'];
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/group-edit-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>