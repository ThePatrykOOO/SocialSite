<?php
namespace User;
include_once 'errors.php';
include_once 'connect.php';
session_start();
class User extends \Connect\Connect
{
    public function youlogged()
    {
        if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
            header('Location: ../welcome');
            exit();
        }
    }
    public function login($emailLogin=null, $password=null)
    {
        $emailLogin = htmlentities($emailLogin, ENT_QUOTES, "UTF-8");
        $sql = "SELECT * FROM users WHERE email='$emailLogin'";
        $question = \Connect\Connect::connect()->query($sql);
        $count = $question->RowCount();
        if ($count > 0) {
            $result = $question->fetch();
            if(password_verify($password, $result['password']))
            {
                $_SESSION['logged'] = true;
                $_SESSION['iduser'] = $result['id'];
                $_SESSION['fullName'] = $result['name']." ".$result['surname'];
                unset($_SESSION['errorLogin']);
                header('location: user/main');
            } else {
                $_SESSION['errorLogin'] = ["Nie znaleziono użytkownika o takim loginie i haśle!"];
            }
        } else {
            $_SESSION['errorLogin'] = ["Nie znaleziono użytkownika o takim loginie i haśle!"];
        }
    }
    public function editProfil($birth=null, $home=null, $school=null, $phone=null, $about=null)
    {
        echo "Kappa";
    }
}