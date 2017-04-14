<?php
    require '../vendor/autoload.php';
    if(isset($_POST['accept'])) \User\User::acceptFriend($_POST['accept']);
    if(isset($_POST['delete'])) \User\User::ignoreFriend($_POST['delete']);
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if(isset($_POST['message'])) \User\User::sendMessage($_POST['message'],$id);
    $question = \Connect\Connect::connect()->prepare("SELECT * FROM users WHERE id=:id");
    $question->bindValue(':id', $id, PDO::PARAM_INT);
    $question->execute();
    $result = $question->fetch();
    $fullname = $result['name']." ".$result['surname'];
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php
    if ($id == 0) {
        include '../content/messages-list.php';
    } else {
        include '../content/messages-content.php';
    }

?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>

