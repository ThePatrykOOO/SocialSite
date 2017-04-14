<?php
    session_start();
    session_destroy();
    if(isset($_COOKIE['emailLogin']) && isset($_COOKIE['password'])) {
        unset($_COOKIE['emailLogin']);
        unset($_COOKIE['password']);
        setcookie('emailLogin', null, -1, '/');
        setcookie('password', null, -1, '/');
    }
    header("Location: ../index.php");