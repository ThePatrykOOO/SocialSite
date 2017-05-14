<?php
require_once '../vendor/load-class.php';
$id = isset($_GET['id']) ? strval($_GET['id']): 0;
?>
<?php include '../includes/head.php';?>
<?php include '../includes/navbar.php';?>
<?php include '../includes/leftside.php';?>
<?php include '../content/friend-content.php';?>
<?php include '../includes/rightside.php';?>
<?php include '../includes/footer.php';?>

