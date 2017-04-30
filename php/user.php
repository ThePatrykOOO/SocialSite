<?php
namespace User;
if (isset($_SESSION['logged'])) {
    require_once '../vendor/autoload.php';
    require_once '../vendor/load-class.php';
}
use \Sign\SignUp as SignUp;
use PDO;
class User extends \Connect\Connect
{
    public static function youlogged()
    {
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
            header('Location: ../welcome');
            exit();
        }
    }
    public static function login($emailLogin = null, $password = null, $remember = null)
    {
        $emailLogin = htmlentities($emailLogin, ENT_QUOTES, "UTF-8");
        $sql = "SELECT * FROM users WHERE email='$emailLogin'";
        $question = \Connect\Connect::connect()->query($sql);
        $count = $question->RowCount();
        if ($count > 0) {
            $result = $question->fetch();
            if (password_verify($password, $result['password'])) {
                $_SESSION['logged'] = true;
                $_SESSION['iduser'] = $result['id'];
                $_SESSION['fullName'] = $result['name'] . " " . $result['surname'];
                unset($_SESSION['errorLogin']);
                if (isset($remember)) {
                    setcookie("emailLogin", $emailLogin, time() + (86400 * 30), "/"); // 86400 = 1 day
                    setcookie("password", $password, time() + (86400 * 30), "/");
                }
                header('location: user/main');
            } else {
                $_SESSION['errorLogin'] = ["Nie znaleziono użytkownika o takim loginie i haśle!"];
            }
        } else {
            $_SESSION['errorLogin'] = ["Nie znaleziono użytkownika o takim loginie i haśle!"];
        }
    }
    private static function checkHome($home)
    {
        $home = htmlentities($home, ENT_QUOTES, "UTF-8");
        if (strlen($home) > 100) {
            $_SESSION['errorUser'] = ["Miejsce zamieszkania ma za dużo znaków"];
        }
    }
    private static function checkWork($work)
    {
        $work = htmlentities($work, ENT_QUOTES, "UTF-8");
        if (strlen($work) > 100) {
            $_SESSION['errorUser'] = ["Twoja praca ma za dużo znaków"];
        }
    }
    private static function checkSchool($school)
    {
        $school = htmlentities($school, ENT_QUOTES, "UTF-8");
        if (strlen($school) > 100) {
            $_SESSION['errorUser'] = ["Nazwa szkoły ma za dużo znaków"];
        }
    }
    private static function checkPhone($phone)
    {
//        if(strlen($phone)!=9 || !is_int($phone)) {
//            $_SESSION['errorUser'] = "Wpisz poprawny numer telefonu!";
//        }
    }
    private static function checkAbout($about)
    {
        $about = htmlentities($about, ENT_QUOTES, "UTF-8");
        if (strlen($about) <= 10) {
            $_SESSION['errorUser'] = ["Opis ma za mało znaków min. 10"];
        }
    }
    public static function editProfil($birth = null, $home = null, $worked = null, $school = null, $phone = null, $about = null)
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
            $question->bindValue(':birth', $birth, PDO::PARAM_STR);
            $question->bindValue(':home', $home, PDO::PARAM_INT);
            $question->bindValue(':worked', $worked, PDO::PARAM_INT);
            $question->bindValue(':school', $school, PDO::PARAM_INT);
            $question->bindValue(':phone', $phone, PDO::PARAM_INT);
            $question->bindValue(':about', $about, PDO::PARAM_INT);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->execute();
            if ($question) {
                $_SESSION['success'] = "Udało Ci się edytować profil";
            }

        }

    } //niedokonczone

    public static function changePass($passOld = null, $pass1 = null, $pass2 = null)
    {
        $question = \Connect\Connect::connect()->prepare("SELECT password FROM users WHERE id=:id");
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_INT);
        $question->execute();
        $result = $question->fetch();
        if (!password_verify($passOld, $result['password'])) {
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
        $_SESSION['success'] = "Hasło zostało zmienione";
    }

    private static function checkName($name)
    {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if (strlen($name) > 50) {
            $_SESSION['errorUser'] = ["Nazwa ma za dużo znaków"];
        }
    }
    private static function checkDescribe($describe)
    {
        $describe = htmlentities($describe, ENT_QUOTES, "UTF-8");
        if (strlen($describe) > 300) {
            $_SESSION['errorUser'] = ["Opis strony ma za dużo znaków"];
        }
    }
    private static function checkType($type)
    {
        $sql = "SELECT id FROM type_site WHERE id=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $type, PDO::PARAM_INT);
        $question->execute();
        if ($question->rowCount() == 0) {
            $_SESSION['errorUser'] = ["Nie ma takiej Kategorii"];
        }
        if ($type == "null") {
            $_SESSION['errorUser'] = ["Wybierz kategorię!"];
        }
    }
    public static function newSite($name = null, $describe = null, $type = null)
    {
        \User\User::checkName($name);
        \User\User::checkDescribe($describe);
        \User\User::checkType($type);
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "INSERT INTO sites VALUES(NULL,:name,:describe,:type,:id,1)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':name', $name, PDO::PARAM_STR);
            $question->bindValue(':describe', $describe, PDO::PARAM_STR);
            $question->bindValue(':type', $type, PDO::PARAM_STR);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->execute();
            if ($question) {
                $_SESSION['success'] = "Utworzyłeś właśnie nową stronę, przejdź do zakładki moje strony po lewej stronie";
                header("Location: moje-strony");
            }
        }

    }
    public static function showMySite()
    {
        $sql = "SELECT name, idsite FROM sites WHERE admin=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();

        foreach ($question as $value) {
            $id = $value['idsite'];
            echo '<tr>
            <td>
                <a href="page?id=' . $id . '">' . $value['name'] . '</a>
            </td>
            <td>
                <form method="post">
                    <button type="submit" name="deleteSites" class="btn btn-danger btn-xs" value="'.$id.'"><i class="fa fa-trash-o" title="Usuń Stronę"></i></button>
                </form>
            </td>
            <td>
                <a href="edytuj-strone?id=' . $id . '"><i class="fa fa-cog" title="Edytuj Stronę"></i></a>
            </td>
        </tr>';
        }
    }
    public static function editSite($name = null, $describe = null, $type = null, $id = null)
    {
        \User\User::checkName($name);
        \User\User::checkDescribe($describe);
        \User\User::checkType($type);
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "UPDATE sites SET name=:name, description=:describe, type=:type WHERE idsite=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':name', $name, PDO::PARAM_STR);
            $question->bindValue(':describe', $describe, PDO::PARAM_STR);
            $question->bindValue(':type', $type, PDO::PARAM_STR);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->execute();
            if ($question) {
                $_SESSION['success'] = "Twoja strona została edytowana";
            }
        }
    }
    public static function likeSiteStatus($id = null)
    {
        $sql = "SELECT id FROM likesite WHERE iduser=:idUser AND idsite=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':idUser', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        $youlike = $question->rowCount();

        $sql = "SELECT id FROM likesite WHERE idsite=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        if ($youlike == 1) {
            echo '<button type="button" value="'.$id.'" name="UnlikeSite" id="UnlikeSite" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-down"></i>Już nie lubię <span class="badge">'.$count.'</span></button>';
        } elseif ($youlike == 0) {
            echo '<button type="button" value="'.$id.'" name="likeSite" id="likeSite" class="btn btn-success btn-xs "><i class="fa fa-thumbs-o-up"></i>Polub <span class="badge">'.$count.'</span></button>';
        } else {
            echo "Błąd z polubieniami stron";
        }


    }
    public static function likeSite($id)
    {
        $sql = "INSERT INTO likesite VALUES(NULL,:id,:idUser)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->bindValue(':idUser', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
    }
    public static function unlikeSite($id)
    {
        $sql = "DELETE FROM likesite WHERE iduser=:idUser AND idsite=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->bindValue(':idUser', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
    }
    public static function deleteSite($id)
    {
        $sql = "SELECT admin FROM sites WHERE idsite=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        $result = $question->fetch();
        if ($_SESSION['iduser'] == $result['admin']) {
            //        usuwanie postów, komentarzy, lajków
            $sql = "SELECT id FROM posts WHERE idtype=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->execute();
            foreach ($question as $value) {
                $id = $value['id'];
//        usuwanie komentarzy
                $sql = "DELETE FROM commentpost WHERE idpost=:id";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $id, PDO::PARAM_STR);
                $question->execute();
//        usuwanie lajków postów
                $sql = "DELETE FROM likepost WHERE idpost=:id";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $id, PDO::PARAM_STR);
                $question->execute();
//        usuwanie  postów
                $sql = "DELETE FROM posts WHERE id=:id";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $id, PDO::PARAM_STR);
                $question->execute();
            }

//        usuwanie strony
            $sql = "DELETE FROM sites WHERE idsite=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->execute();

            $_SESSION['success'] = "Usunięto stronę";
        } else {
            $_SESSION['errorUser'] = ["Nie kombinuj tutaj, strona jest zabezpieczona przed takimi atakami :)"];
        }


    }

    private static function checkNameSaved($name)
    {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if (strlen($name) > 50) {
            $_SESSION['errorUser'] = ["Nazwa jest zbyt długa!"];
        }
    }
    private static function checkUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $_SESSION['errorUser'] = ["Niepoprawny adres URL strony!"];
        }
    }
    public static function addSave($name = null, $url = null)
    {
        \User\User::checkNameSaved($name);
        \User\User::checkUrl($url);
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "INSERT INTO saved VALUES(NULL,:name,:url,:id)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':name', $name, PDO::PARAM_STR);
            $question->bindValue(':url', $url, PDO::PARAM_STR);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->execute();
            if ($question) {
                $_SESSION['success'] = "Utworzyłeś nową zapisaną stronę";
            }
        }
    }
    public static function showSaved()
    {
        $sql = "SELECT * FROM saved WHERE iduser=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $id = $value['idsave'];
            $name = $value['name_save'];
            $url = $value['url'];
            echo '<tr>
            <td>
                ' . $name . '
            </td>
            <td>
                <a href="' . $url . '" target="_blank"><i class="fa fa-eye" title="Zobacz"></i></a> 
            </td>
            <td>
                <form method="post">
                    <button type="submit" class="btn btn-danger btn-xs" name="delete" value="'.$id.'"><i class="fa fa-trash-o" title="Usuń"></i></button>
                </form>
            </td>
        </tr>';
        }


    }
    public static function deleteSaved($idsave)
    {
        $sql = "SELECT idsave FROM saved WHERE iduser=:id AND idsave=:idsave";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idsave', $idsave, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        if ($count == 1) {
            $sql = "DELETE FROM saved WHERE idsave=:idsave";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':idsave', $idsave, PDO::PARAM_STR);
            $question->execute();
            if ($question) $_SESSION['success'] = "Usunąłeś zapisaną stronę";
        } else {
            $_SESSION['errorUser'] = ["Nie kombinuj tutaj, strona jest zabezpieczona przed takimi atakami :)"];
        }
    }


    public static function searchCheckFriend($idFriend)
    {
        $sql = "SELECT id FROM friendrequest WHERE ((fromUser=:id AND toUser=:idFriend) OR (fromUser=:idFriend AND toUser=:id)) AND status=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idFriend, PDO::PARAM_STR);
        $question->execute();
        $result = $question->rowCount();
        if ($result == 1) {
            echo '<form method="POST">
                    <button type="submit" name="unfriend" class="btn btn-warning">Usuń ze znajomych</button>
                  </form>';
        } else {
            $sql = "SELECT id FROM friendrequest WHERE fromUser=:id AND toUser=:idFriend";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idFriend', $idFriend, PDO::PARAM_STR);
            $question->execute();
            $countFrom = $question->rowCount();

            $sql = "SELECT id FROM friendrequest WHERE fromUser=:idFriend AND toUser=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idFriend', $idFriend, PDO::PARAM_STR);
            $question->execute();
            $countTo = $question->rowCount();

            if ($countFrom == 0 && $countTo == 0) {
                $sql = "SELECT name, surname FROM users WHERE id=:idFriend";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':idFriend', $idFriend, PDO::PARAM_STR);
                $question->execute();
                $result = $question->fetch();
                $fullname = $result['name'] . " " . $result['surname'];
                $linkToProfile = "profile?id=".$idFriend;
                echo '
                <a href="' . $linkToProfile . '">' . $fullname . '</a>
                    <form method="POST">
                    <button type="submit" name="sendFriend" value="'.$idFriend.'" class="btn btn-success"><icon class="fa fa-user-plus"></i></button>
                  </form>';
            }
        }
    }
    public static function showSearchFriend()
    {
        $sql = "SELECT id FROM users WHERE id!=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $id = $value['id'];
            \User\User::searchCheckFriend($id);
        }
    }
    public static function checkFriend($idFriend)
    {
        $sql = "SELECT id FROM friendrequest WHERE ((fromUser=:id AND toUser=:idFriend) OR (fromUser=:idFriend AND toUser=:id)) AND status=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idFriend, PDO::PARAM_STR);
        $question->execute();
        $result = $question->rowCount();
        if ($result == 1) {
            echo '<form method="POST">
                    <button type="submit" name="unfriend" class="btn btn-warning">Usuń ze znajomych</button>
                  </form>';
        } else {
            $sql = "SELECT id FROM friendrequest WHERE fromUser=:id AND toUser=:idFriend";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idFriend', $idFriend, PDO::PARAM_STR);
            $question->execute();
            $countFrom = $question->rowCount();

            $sql = "SELECT id FROM friendrequest WHERE fromUser=:idFriend AND toUser=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idFriend', $idFriend, PDO::PARAM_STR);
            $question->execute();
            $countTo = $question->rowCount();

            if ($countFrom == 1) {
                echo '<form method="POST">
                    <button type="submit" name="cancel" class="btn btn-danger">Anuluj Zaproszenie</button>
                  </form>';
            } else if ($countTo == 1) {
                echo '<form method="POST">
                    <button type="submit" name="ignore" class="btn btn-danger">Usuń Zaproszenie</button>
                    <button type="submit" name="accept" class="btn btn-success">Akceptuj</button>
                  </form>';
            } else {
                echo '<form method="POST">
                    <button type="submit" name="send" class="btn btn-success">Wyślij Zaproszenie</button>
                  </form>';
            }
        }
    }
    public static function sendFriend($idfriend)
    {
        $sql = "INSERT INTO friendrequest VALUES(NULL,:id, :idFriend, 0)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public static function acceptFriend($idfriend)
    {
        $sql = "UPDATE friendrequest SET status=1 WHERE fromUser=:idFriend AND toUser=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public static function deleteFriend($idfriend)
    {
        $sql = "DELETE FROM friendrequest WHERE (fromUser=:idFriend AND toUser=:id) OR (fromUser=:id AND toUser=:idFriend)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public static function ignoreFriend($idfriend)
    {
        $sql = "DELETE FROM friendrequest WHERE fromUser=:idFriend AND toUser=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public static function cancelFriend($idfriend)
    {
        $sql = "DELETE FROM friendrequest WHERE fromUser=:id AND toUser=:idFriend";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }

    public static function yourRequestFriend()
    {
        $sql = "SELECT u.id, u.name, u.surname FROM friendrequest as f, users as u WHERE f.toUser=:id AND f.status=0 AND u.id=f.fromUser";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $id = $value['id'];
            $name = $value['name'];
            $surname = $value['surname'];
            echo '<tr>          
                <td><a href="profile?id=' . $id . '">' . $name . " " . $surname . '</a></td>
                <form method="post">
                    <td><button type="submit" name="accept" value="' . $id . '" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></td>
                <td><button type="submit" name="delete" value="' . $id . '" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></button></td>
                </form>
            </tr>';
        }
    }
    public static function chatright()
    {
        $sql = "SELECT u.id, u.name, u.surname FROM friendrequest as f, users as u WHERE (f.fromUser=:id OR f.toUser=:id) AND u.id!=:id AND f.status=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $fullname = $value['name'] . " " . $value['surname'];
            $id = $value['id'];
            echo '<li class="list-group-item"><a href="messages?id=' . $id . '">' . $fullname . '</a> </li>';
        }
    }
    public static function sendMessage($message, $idToSent)
    {

        $message = htmlentities($message, ENT_QUOTES, "UTF-8");
        if (strlen($message) > 1000) {
            $_SESSION['errorUser'] = ["Wiadomość ma za dużo znaków"];
        }
        if (empty($message)) {
            $_SESSION['errorUser'] = ["Wiadomość ma za mało znaków"];
        }
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "INSERT INTO messages VALUES(NULL,:id,:idToSent,:message,now())";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idToSent', $idToSent, PDO::PARAM_STR);
            $question->bindValue(':message', $message, PDO::PARAM_STR);
            $question->execute();
        }
    }
    public static function showMessages($idToSent)
    {
        $sql = "SELECT m.fromUser, m.toUser, m.text FROM messages as m, users as u WHERE ((m.toUser=:id AND m.fromUser=:idToSent) OR (m.toUser=:idToSent AND m.fromUser=:id)) AND u.id=(m.fromUser OR m.toUser)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idToSent', $idToSent, PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $tmptext = $value['text'];
            $text = nl2br($tmptext);

            if ($value['fromUser'] == $_SESSION['iduser']) {
                echo '<div class="alert alert-success">
                        ' . $text . '
                    </div>';
            } else {
                echo '<div class="alert alert-info">
                   ' . $text . '
                </div>';
            }
        }
        echo '<div id="scrollDown"></div>';

    }
    public static function showLastMessage()
    {
//        mają być wyświetlone ostatnie wiadomości usera do ludzi
        $sql = "SELECT u.id, u.name, u.surname FROM friendrequest as f, users as u WHERE (f.fromUser=:id OR f.toUser=:id) AND u.id!=:id AND f.status=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $fullname = $value['name'] . " " . $value['surname'];
            $id = $value['id'];
            echo '<div class="col-lg-6">
                    <li class="list-group-item">
                        <b>' . $fullname . '</b> 
                        <a href="messages?id=' . $id . '"><b class="fa fa-commenting-o"></b></a>
                        <a href="profile?id=' . $id . '"><b class="fa fa-user-o"></b></a> 
                     </li>
                    </div>';
        }
    } //niedokończone

    private static function checkNameGroup($name)
    {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if (strlen($name) > 300) {
            $_SESSION['errorUser'] = ["Nazwa strony jest za długa"];
        }
        if (strlen($name) < 3) {
            $_SESSION['errorUser'] = ["Nazwa strony jest za krótka"];
        }
    }
    private static function addMemberGroup($friends, $id)
    {
//        Dodanie administatora strony
        $sql = "INSERT INTO membersgroup VALUES(NULL,:id,:admin)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->bindValue(':admin', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
//          Dodanie pozostałych członków
        foreach ($friends as $value) {
            $sql = "INSERT INTO membersgroup VALUES(NULL,:id,:member)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->bindValue(':member', $value, PDO::PARAM_STR);
            $question->execute();
        }
    }
    private static function checkStatus($status)
    {
        if ($status == 'Publiczna') $check = 1;
        elseif ($status == 'Niepubliczna') $check = 2;
        elseif ($status == 'Prywatna') $check = 3;
        else $_SESSION['errorUser'] = ["Zaznacz poprawnie status grupy"];
        return $check;
    }
    public static function addGroup($name = null, $status = null, $friends = null)
    {
        \User\User::checkNameGroup($name);
        if (isset($status))
            \User\User::checkStatus($status);
        else
            $_SESSION['errorUser'] = ["Zaznacz status grupy"];

        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "INSERT INTO groups VALUES(NULL,:name,:admin,:status)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':name', $name, PDO::PARAM_STR);
            $question->bindValue(':admin', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':status', \User\User::checkStatus($status), PDO::PARAM_STR);
            $question->execute();
            $sql = "SELECT id FROM groups WHERE admin=:admin ORDER BY id DESC LIMIT 1";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':admin', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->execute();
            $result = $question->fetch();
            \User\User::addMemberGroup($friends, $result['id']);
            $_SESSION['success'] = "Grupa została utworzona. Przejdź do zakładki moje grupy, aby przejść dalej :)";
            header("Location: moje-grupy");
        }
    }
    public static function editGroup($name = null, $status = null, $id = null)
    {
        \User\User::checkNameGroup($name);
        if ($status != null)
            $check = \User\User::checkStatus($status);
        else
            $_SESSION['errorUser'] = ["Zaznacz status grupy"];
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "UPDATE groups SET nameGroup=:name, status=:status WHERE id=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':name', $name, PDO::PARAM_STR);
            $question->bindValue(':status', $check, PDO::PARAM_STR);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->execute();
            $_SESSION['success'] = "Grupa została edytowana";
        }
    }
    public static function showMyGroup()
    {
        $sql = "SELECT nameGroup, id FROM groups WHERE admin=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();

        foreach ($question as $value) {
            $id = $value['id'];
            echo '<tr>
            <td>
                <a href="grupa?id=' . $id . '">' . $value['nameGroup'] . '</a>
            </td>
            <td>
                <form method="post">
                    <button type="submit" name="deleteGroup" class="btn btn-danger btn-xs" value="'.$id.'"><i class="fa fa-trash-o" title="Usuń Stronę"></i></button>
                </form>
            </td>
            <td>               
                <a href="edytuj-grupe?id=' . $id . '"><i class="fa fa-cog" title="Edytuj Grupę"></i></a>
            </td>
        </tr>';
        }
    }
    public static function showStatusGroup($status)
    {
        if ($status == '1') $check = "Publiczna";
        elseif ($status == '2') $check = "Niepubliczna";
        elseif ($status == '3') $check = "Prywatna";
        else $check = "Błąd";
        return $check;
    }
    public static function showCountMembersGroup($id)
    {
        $question = \Connect\Connect::connect()->prepare("SELECT id FROM membersgroup WHERE idgroup=:id");
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        echo '<a href="czlonkowie?id=' . $id . '">' . $count . ' Członków</a>';
    }
    public static function showMembersGroup($id)
    {
        $sql = "SELECT u.id, u.name, u.surname FROM membersgroup as m, users as u WHERE u.id=m.iduser AND m.idgroup=:id";
        $question = \Connect\Connect::connect()->query($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $idUser = $value['id'];
            $fullname = '<a href="profile?id=' . $idUser . '"><b class="fa fa-user-o"> ' . $value['name'] . " " . $value['surname'] . '</b> </a>';
            echo '<div class="col-lg-6">
                    <li class="list-group-item">
                        ' . $fullname;
            \User\User::showDeleteMembersGroup($idUser, $id);
            echo '</li>
                    </div>';
        }


    }
    public static function showDeleteMembersGroup($idUser, $id)
    {
        $sql = "SELECT u.id FROM membersgroup as m, users as u, groups as g WHERE u.id=m.iduser=g.admin AND m.idgroup=:id AND m.iduser=g.admin AND m.iduser=:idUser";
        $question = \Connect\Connect::connect()->query($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->bindValue(':idUser', $idUser, PDO::PARAM_STR);
        $question->execute();
        $result = $question->fetch();
        $idUser = $result['id'];
        if ($question->rowCount() == 1) {
            echo '<form method="post" class="inline-block">
                <button type="submit" class="inline-block" name="delete" value="' . $idUser . '"><i class="fa fa-trash-o" title="Usuń Użytkownika"></i></button>
                </form>';
        }
    }
    public static function deleteMemberGroup($idUser, $id)
    {
        $sql = "DELETE FROM membersgroup WHERE idgroup=:id AND iduser=:idUser";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->bindValue(':idUser', $idUser, PDO::PARAM_STR);
        $question->execute();
        if ($question) {
            $_SESSION['success'] = "Usunięcie użytkownika z grupy ... Zakończyło się pomyślnie :)";
        }
    }
    public static function addUserGroup($friends,$id)
    {
        //funkcja do dodawania członków gdy grupa jest już stworzona
        foreach ($friends as $value) {
            $sql = "INSERT INTO membersgroup VALUES(NULL,:id,:member)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->bindValue(':member', $value, PDO::PARAM_STR);
            $question->execute();
        }
    }
    public static function deleteGroup($id)
    {
        $sql = "SELECT admin FROM groups WHERE id=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        $result = $question->fetch();
        if ($_SESSION['iduser'] == $result['admin']) {
            //        usuwanie postów, komentarzy, lajków
            $sql = "SELECT id FROM posts WHERE idtype=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->execute();
            foreach ($question as $value) {
                $id = $value['id'];
//        usuwanie komentarzy
                $sql = "DELETE FROM commentpost WHERE idpost=:id";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $id, PDO::PARAM_STR);
                $question->execute();
//        usuwanie lajków postów
                $sql = "DELETE FROM likepost WHERE idpost=:id";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $id, PDO::PARAM_STR);
                $question->execute();
//        usuwanie  postów
                $sql = "DELETE FROM posts WHERE id=:id";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $id, PDO::PARAM_STR);
                $question->execute();
            }

//        usuwanie userów
            $sql = "DELETE FROM membersgroup WHERE idgroup=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->execute();
//        ususuwanie grupy
            $sql = "DELETE FROM groups WHERE id=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->execute();

            $_SESSION['success'] = "Usunięto grupę";
        } else {
            $_SESSION['errorUser'] = ["Nie kombinuj tutaj, strona jest zabezpieczona przed takimi atakami :)"];
        }


    }

    private static function checkTextPost($text)
    {
        $tmptext = htmlentities($text, ENT_QUOTES, "UTF-8");
        $text = nl2br($tmptext);
        if (strlen($text) > 3000) {
            $_SESSION['errorUser'] = ["Post ma za dużo znaków"];
        }
        if (strlen($text) < 5) {
            $_SESSION['errorUser'] = ["Post musi mieć co najmniej 5 znaków"];
        }
    }
    public static function addPost($typeAutor = null, $text = null, $idtype = null)
    {
        \User\User::checkTextPost($text);
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            if ($typeAutor == 3 || $typeAutor == 2) $id = $idtype; else $id = null;
            $sql = "INSERT INTO posts VALUES(NULL,:typeAutor,:idg,:idautor,:text,now(),1)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':typeAutor', $typeAutor, PDO::PARAM_STR);
            $question->bindValue(':idg', $id, PDO::PARAM_STR);
            $question->bindValue(':idautor', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':text', $text, PDO::PARAM_STR);
            $question->execute();
        }
    }
    private static function countLikePost($idPost, $status)
    {
        $sql = "SELECT id FROM likepost WHERE idpost=:idpost AND status=:status";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
        $question->bindValue(':status', $status, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        return $count;
    }
    private static function postIslike($fullname,$data,$text,$idPost)
    {
        $count = \User\User::countLikePost($idPost,1);
        echo '<div class="col-lg-12 post">
            <h4>' . $fullname . '<small>' . $data . '</small></h4>
            <p>' . $text . '</p>
            <div class="optionsPost">
                <button type="submit" value="'.$idPost.'" name="alreadyUnlike" class="btn btn-default btn-xs alreadyUnlike"><i class="fa fa-thumbs-o-up"></i>Lubię <span class="badge">'.$count.'</span></button>';
    }
    private static function postIsUnlike($fullname,$data,$text,$idPost)
    {
        $count = \User\User::countLikePost($idPost,0);
        echo '<div class="col-lg-12 post">
            <h4>' . $fullname . '<small>' . $data . '</small></h4>
            <p>' . $text . '</p>
            <div class="optionsPost">
                <button type="submit" value="'.$idPost.'" class="btn btn-default btn-xs alreadyLike"><i class="fa fa-thumbs-o-down"></i>Nie lubię <span class="badge">'.$count.'</span></button>';
    }
    private static function postDefault($fullname,$data,$text,$idPost)
    {
        $countLike = \User\User::countLikePost($idPost,1);
        $countUnlike = \User\User::countLikePost($idPost,0);
        echo '<div class="col-lg-12 post">
            <h4>' . $fullname . '<small>' . $data . '</small></h4>
            <p>' . $text . '</p>
            <div class="optionsPost">
                <button type="button" value="'.$idPost.'" name="like" class="btn btn-success btn-xs likePost"><i class="fa fa-thumbs-o-up"></i>Polub <span class="badge">'.$countLike.'</span></button>
                <button type="button" value="'.$idPost.'" name="unlike" class="btn btn-danger btn-xs unLikePost"><i class="fa fa-thumbs-o-down"></i>Nie lubię <span class="badge">'.$countUnlike.'</span></button>';

    }
    public static function likePost($idPost = null)
    {
        $sql = "SELECT id FROM likepost WHERE idpost=:idpost AND idperson=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        if($count == 0) {
            $sql = "INSERT INTO likepost VALUES(NULL,:idpost,:id,1)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
            $question->execute();
        }
    }
    public static function alreadyUnlike($idPost = null)
    {
        $sql = "SELECT id FROM likepost WHERE idpost=:idpost AND idperson=:id AND status=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        if($count == 1) {
            $sql = "DELETE FROM likepost WHERE idpost=:idpost AND idperson=:id AND status=1";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
            $question->execute();
        }
    }
    public static function unLikePost($idPost = null)
    {
        $sql = "SELECT id FROM likepost WHERE idpost=:idpost AND idperson=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        if($count == 0) {
            $sql = "INSERT INTO likepost VALUES(NULL,:idpost,:id,0)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
            $question->execute();
        }
    }
    public static function alreadyLike($idPost = null)
    {
        $sql = "SELECT id FROM likepost WHERE idpost=:idpost AND idperson=:id AND status=0";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        if($count == 1) {
            $sql = "DELETE FROM likepost WHERE idpost=:idpost AND idperson=:id AND status=0";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
            $question->execute();
        }
    }

    private static function echoPost($question)
    {
        foreach ($question as $value) {
            $idPost = $value['idPost'];
            $id = $value['idUser'];
            $idtype = $value['idtype'];
            if(isset($value['typeAutor']) && $value['typeAutor'] == 2) {
                $sql = "SELECT s.name FROM posts as p, sites as s WHERE p.id=:id AND p.idtype=s.idsite";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $idPost, PDO::PARAM_STR);
                $question->execute();
                $result = $question->fetch();
                $nameSite = $result['name'];
                $fullname = '<a href="page?id='.$idtype.'">'.$nameSite.'</a>';
            } elseif (isset($value['typeAutor']) && $value['typeAutor'] == 3) {
                $sql = "SELECT g.nameGroup FROM posts as p, groups as g WHERE p.id=:id AND p.idtype=g.id";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $idPost, PDO::PARAM_STR);
                $question->execute();
                $result = $question->fetch();
                $nameGroup = $result['nameGroup'];
                $fullname = '<a href="profile?id='.$id.'">'.$value['name'] . " " . $value['surname'].'</a> <i class="fa fa-caret-right"></i> '.' <a href="grupa?id='.$idtype.'">'.$nameGroup.'</a>';
            } else {
                $fullname = '<a href="profile?id='.$id.'">'.$value['name'] . " " . $value['surname'].'</a>';

            }
            $data = $value['data'];
            $tmptext = $value['text'];
            $text = nl2br($tmptext);

            $sql = "SELECT id FROM likepost WHERE idpost=:idpost AND idperson=:id AND status=1";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
            $question->execute();
            $count = $question->rowCount();
            if ($count == 1) {
                \User\User::postIslike($fullname,$data,$text,$idPost);
            } else {
                $sql = "SELECT id FROM likepost WHERE idpost=:idpost AND idperson=:id AND status=0";
                $question = \Connect\Connect::connect()->prepare($sql);
                $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
                $question->bindValue(':idpost', $idPost, PDO::PARAM_STR);
                $question->execute();
                $count = $question->rowCount();
                if ($count == 1) {
                    \User\User::postIsUnlike($fullname,$data,$text,$idPost);
                } else {
                    \User\User::postDefault($fullname,$data,$text,$idPost);
                }
            }
            if(!isset($GLOBALS['seemore'])) {
                echo ' <a href="post?id=' . $idPost . '" role="button" class="btn btn-info btn-xs">Zobacz »</a>';
            }
            echo '</div>
              </div>';
        }
    }
    public static function showMainPost()
    {
        $idPost = array();
//        moje posty
        $sql = "SELECT id FROM posts WHERE idAutor=:id AND typeAutor=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            array_push($idPost,$value['id']);
        }
//        posty znajomych
        $sql = "SELECT p.id FROM posts as p, friendrequest as f, users as u WHERE u.id=p.idAutor AND p.typeAutor=1 AND (f.fromUser=:id OR f.toUser=:id) AND typeAutor=1 AND p.idAutor!=:id AND f.status=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            array_push($idPost,$value['id']);
        }
//        posty polubionych stron
        $sql = "SELECT p.id FROM posts as p, sites as s, likesite as l WHERE p.idtype=s.idsite=l.idsite AND p.idAutor=l.iduser AND p.typeAutor=2 AND l.iduser=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            array_push($idPost,$value['id']);
        }
//        posty od grup
        $sql = "SELECT p.id FROM posts as p, membersgroup as m, groups as g WHERE p.idtype=g.id=m.idgroup AND p.idAutor=m.iduser AND p.typeAutor=3";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            array_push($idPost,$value['id']);
        }



        rsort($idPost);
        for ($i = 0; $i < count($idPost); $i++) {
            $value = intval($idPost[$i]);
            $sql = "SELECT u.id as idUser, u.name,s.name as nameSite, u.surname, p.id as idPost, p.text, p.data,p.typeAutor, p.idtype FROM posts as p, users as u, sites as s WHERE p.id='".$value."' AND u.id=p.idAutor=s.admin";
            $question = \Connect\Connect::connect()->query($sql);
            \User\User::echoPost($question);
        }

    }
    public static function showGroupPost($id)
    {
        $sql = "SELECT u.id as idUser, u.name, u.surname, p.id as idPost, p.text, p.data, p.idtype FROM posts as p, users as u WHERE u.id=p.idAutor AND (p.typeAutor=3 AND p.idtype=:id) ORDER BY p.id DESC";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        \User\User::echoPost($question);
    }
    public static function showPagePost($id)
    {
        $sql = "SELECT u.id as idUser, s.name as nameSite, p.id as idPost, p.text, p.data, p.typeAutor,p.idtype FROM posts as p, users as u, sites as s WHERE u.id=p.idAutor=s.admin AND (p.typeAutor=2 AND p.idtype=:id) ORDER BY p.id DESC";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        \User\User::echoPost($question);
    }
    public static function showMyPost()
    {
        $sql = "SELECT u.id as idUser, u.name, s.name as nameSite, u.surname, p.id as idPost, p.text, p.data,p.typeAutor,p.idtype FROM posts as p, users as u, sites as s WHERE u.id=p.idAutor=s.admin AND p.idAutor=:id ORDER BY p.id DESC";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        \User\User::echoPost($question);
    }
    public static function showProfilePost($id)
    {
        $sql = "SELECT u.id as idUser, u.name, u.surname, p.id as idPost, p.text, p.data,p.idtype FROM posts as p, users as u WHERE u.id=p.idAutor AND p.idAutor=:id AND p.typeAutor=1 ORDER BY p.id DESC";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        \User\User::echoPost($question);
    }
    public static function showPost($id)
    {
        $sql = "SELECT u.id as idUser, u.name, u.surname, p.id as idPost, p.text, p.data,p.idtype FROM posts as p, users as u WHERE u.id=p.idAutor AND p.id=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        \User\User::echoPost($question);
    }

    private static function checkComment($comment)
    {
        $tmpcomment = htmlentities($comment, ENT_QUOTES, "UTF-8");
        $comment = nl2br($tmpcomment);
        if (strlen($comment) > 500) {
            $_SESSION['errorUser'] = ["Komentarz ma za dużo znaków"];
        }
        if (strlen($comment) < 2) {
            $_SESSION['errorUser'] = ["Komentarz jest za krótki"];
        }
    }
    public static function addComment ($comment,$id)
    {
        \User\User::checkComment($comment);
        if (!isset($_SESSION['errorUser']) || count($_SESSION['errorUser']) == 0) {
            $sql = "INSERT INTO commentpost VALUES(NULL,:id,:idautor,:comment)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->bindValue(':idautor', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->bindValue(':comment', $comment, PDO::PARAM_STR);
            $question->execute();
        }

    }
    public static function showComment($id)
    {
        $sql = "SELECT u.id, u.name, u.surname, c.comment FROM commentpost as c, users as u WHERE u.id=c.idAutor AND c.idpost=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $id = $value['id'];
            $fullname = '<a href="profile?id='.$id.'">'.$value['name'] . " " . $value['surname'].'</a>';
            echo '<div class="col-lg-12 post">
            <h6>'.$fullname.'</h6>
            <p class="comment-text">'.$value['comment'].'</p>
            </div>';
        }
    }

}