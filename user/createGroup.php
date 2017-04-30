<?php
require_once '../vendor/load-class.php';

    if (isset($_POST['nameGroup'])) {
        if (isset($_POST['FriendGroup']))
            $friend = $_POST['FriendGroup'];
        else
            $friend = null;

        if (isset($_POST['statusGroup']))
            $statusGroup = $_POST['statusGroup'];
        else
            $statusGroup = null;

        \User\User::addGroup($_POST['nameGroup'], $statusGroup, $friend);
    }
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/createGroup-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>