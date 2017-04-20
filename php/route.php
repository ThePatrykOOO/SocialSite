<?php
require '../vendor/autoload.php';
if (isset($_POST['action'])) {
    if ($_POST['action'] === "showMessage") {
        \User\User::showMessages($_POST['id']);
    }
    if ($_POST['action'] === "sendMessage") {
        \User\User::sendMessage($_POST['message'],$_POST['id']);
    }
    if ($_POST['action'] === "showMainPost") {
        \User\User::showMainPost();
    }
    if ($_POST['action'] === "addPost") {
        \User\User::addPost($typeAutor=1,$_POST['postText']);
    }
    if ($_POST['action'] === "likePost") {
        \User\User::likePost($_POST['id']);
    }
    if ($_POST['action'] === "alreadyUnlike") {
        \User\User::alreadyUnlike($_POST['id']);
    }
    if ($_POST['action'] === "alreadyLike") {
        \User\User::alreadyLike($_POST['id']);
    }
    if ($_POST['action'] === "unLikePost") {
        \User\User::unLikePost($_POST['id']);
    }
    if ($_POST['action'] === "UnlikeSite") {
        \User\User::unlikeSite($_POST['id']);
    }
    if ($_POST['action'] === "likeSite") {
        \User\User::likeSite($_POST['id']);
    }
    if ($_POST['action'] === "showPageStatus") {
        \User\User::likeSiteStatus($_POST['id']);
    }
//    if ($_POST['action'] === "showErrors") {
//        if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
//            \Error\Error::showErrors($_SESSION['errorUser']);
//            unset($_SESSION['errorUser']);
//        } w fazie myślenia jak zrealizować aby błędy pojawiały się bez próby przeładowania
//    }
}
