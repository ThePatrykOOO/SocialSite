<?php

require_once "../php/Connect.php";
require_once "../php/Page.php";
require_once "../php/User.php";
require_once "../php/Errors.php";
require_once "../php/Success.php";
require_once "../php/Signup.php";
$user = new \User\User();
$sign = new \Sign\SignUp();
$error = new \Error\Error();
$success = new \User\Success();
$page = new \Page\Page();
$connect = new Connect\Connect();