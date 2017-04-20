<?php
    require '../vendor/autoload.php';
    $id = isset($_GET['id']) ? strval($_GET['id']): 0;
    if (isset($_POST['delete'])) \User\User::deleteMemberGroup($_POST['delete'],$id)

?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/membersgroup-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>
