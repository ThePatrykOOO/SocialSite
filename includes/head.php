<?php
	\User\User::youlogged();
    if(isset($_POST['accept'])) \User\User::acceptFriend($_POST['accept']);
    if(isset($_POST['delete'])) \User\User::ignoreFriend($_POST['delete']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Social Site</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
</head>