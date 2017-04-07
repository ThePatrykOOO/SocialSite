<?php
    session_start();
    require '../php/user.php';
    use \User\User as User;
    include '../php/page.php';
    use User\Page;
    if (isset($_POST['nameSite']))
        \User\User::newSite($_POST['nameSite'],$_POST['describeSite'],$_POST['typeSite']);
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/createSite-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>