<?php
namespace User;

include_once 'connect.php';
include_once 'signup.php';
use PDO;
use SignUp\SignUp as SignUp;
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
            echo "PASS $password HASH: ". $result['password'];
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
    private function checkHome($home)
    {
        $home = htmlentities($home, ENT_QUOTES, "UTF-8");
        if(strlen($home) > 100) {
            $_SESSION['errorUser'] = ["Miejsce zamieszkania ma za dużo znaków"];
        }
    }
    private function checkWork($work)
    {
        $work = htmlentities($work, ENT_QUOTES, "UTF-8");
        if(strlen($work) > 100) {
            $_SESSION['errorUser'] = ["Twoja praca ma za dużo znaków"];
        }
    }
    private function checkSchool($school)
    {
        $school = htmlentities($school, ENT_QUOTES, "UTF-8");
        if(strlen($school) > 100) {
            $_SESSION['errorUser'] = ["Nazwa szkoły ma za dużo znaków"];
        }
    }
    private function checkPhone($phone)
    {
//        if(strlen($phone)!=9 || !is_int($phone)) {
//            $_SESSION['errorUser'] = "Wpisz poprawny numer telefonu!";
//        }
    }
    private function checkAbout($about)
    {
        $about = htmlentities($about, ENT_QUOTES, "UTF-8");
        if(strlen($about) <= 10) {
            $_SESSION['errorUser'] = ["Opis ma za mało znaków min. 10"];
        }
    }
    public function editProfil($birth=null, $home=null, $worked=null, $school=null, $phone=null, $about=null)
    {
        SignUp::checkbirth($birth);
        \User\User::checkHome($home);
        \User\User::checkWork($worked);
        \User\User::checkSchool($school);
        \User\User::checkPhone($phone);
        \User\User::checkAbout($about);
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "UPDATE users SET birth=:birth, home=:home,work=:worked, school=:school, phone=:phone, about=:about WHERE id=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':birth',$birth, PDO::PARAM_STR);
            $question->bindValue(':home', $home, PDO::PARAM_INT);
            $question->bindValue(':worked', $worked, PDO::PARAM_INT);
            $question->bindValue(':school', $school, PDO::PARAM_INT);
            $question->bindValue(':phone', $phone, PDO::PARAM_INT);
            $question->bindValue(':about', $about, PDO::PARAM_INT);
            $question->bindValue(':id',$_SESSION['iduser'], PDO::PARAM_STR);
            $question->execute();
            if($question) {
                $_SESSION['success'] = "Udało Ci się edytować profil";
            }

        }

    } //niedokonczone
    public function changePass($passOld=null, $pass1=null, $pass2=null)
    {
        $question = \Connect\Connect::connect()->prepare("SELECT password FROM users WHERE id=:id");
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_INT);
        $question->execute();
        $result = $question->fetch();
        if(!password_verify($passOld,$result['password'])) {
            $_SESSION['errorUser'] = ["Podałeś złe stare hasło!"];
        }
        if ($pass1 !== $pass2) {
            $_SESSION['errorUser'] = ["Hasła nie są identyczne"];
        }
        $pass = SignUp::checkPassword($pass1);
        $question = \Connect\Connect::connect()->prepare("UPDATE users SET password=:pass WHERE id=:iduser");
        $question->bindValue(':iduser', $_SESSION['iduser'], PDO::PARAM_INT);
        $question->bindValue(':pass', $pass, PDO::PARAM_INT);
        $question->execute();
//        Dodaj info o  pomyślnej zmianie hasła
    }
    private function checkName($name)
    {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if(strlen($name) > 50) {
            $_SESSION['errorUser'] = ["Nazwa ma za dużo znaków"];
        }
    }
    private function checkDescribe($describe)
    {
        $describe = htmlentities($describe, ENT_QUOTES, "UTF-8");
        if(strlen($describe) > 300) {
            $_SESSION['errorUser'] = ["Opis strony ma za dużo znaków"];
        }
    }
    private function checkType($type)
    {
        $question = \Connect\Connect::connect()->prepare("SELECT id FROM type_site WHERE id=:id");
        $question->bindValue(':id', $type, PDO::PARAM_INT);
        $question->execute();
        if ($question->rowCount() != 1) {
            $_SESSION['errorUser'] = ["Nie ma takiej Kategorii"];
        }
        if ($type = "null") {
            $_SESSION['errorUser'] = ["Wybierz kategorię!"];
        }
    }
    public function newSite($name=null, $describe=null, $type=null)
    {
        \User\User::checkName($name);
        \User\User::checkDescribe($describe);
        \User\User::checkType($type);

    } //niedokończone
    private function checkNameSaved($name)
    {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if(strlen($name) > 50) {
            $_SESSION['errorUser'] = ["Nazwa jest zbyt długa!"];
        }
    }
    private function checkUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $_SESSION['errorUser'] = ["Niepoprawny adres URL strony!"];
        }
    }
    public function addSave($name=null, $url=null)
    {
        \User\User::checkNameSaved($name);
        \User\User::checkUrl($url);
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "INSERT INTO saved VALUES(NULL,:name,:url,:id)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':name',$name, PDO::PARAM_STR);
            $question->bindValue(':url',$url, PDO::PARAM_STR);
            $question->bindValue(':id',$_SESSION['iduser'], PDO::PARAM_STR);
            $question->execute();
            if($question) {
                $_SESSION['success'] = "Utworzyłeś nową zapisaną stronę";
            }
        }
    }
    public function showSaved()
    {
        $sql = "SELECT * FROM saved WHERE iduser=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id',$_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $id = $value['idsave'];
            $name = $value['name_save'];
            $url = $value['url'];
            echo '<tr>
            <td>
                '.$name.'
            </td>
            <td>
                <a href="'.$url.'" target="_blank"><i class="fa fa-eye" title="Zobacz"></i></a> 
            </td>
            <td>
                <a href="zapisane?del='.$id.'"><i class="fa fa-trash-o" title="Usuń"></i></a>
            </td>
        </tr>';
        }


    }
    public function deleteSaved($idsave)
    {
        $sql = "SELECT idsave FROM saved WHERE iduser=:id AND idsave=:idsave";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id',$_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idsave',$idsave, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        if ($count == 1) {
            $sql = "DELETE FROM saved WHERE idsave=:idsave";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':idsave',$idsave, PDO::PARAM_STR);
            $question->execute();
            if($question) {
                $_SESSION['success'] = "Usunąłeś zapisaną stronę";
            }
        }
    }
}