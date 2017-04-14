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
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
            header('Location: ../welcome');
            exit();
        }
    }
    public function login($emailLogin = null, $password = null, $remember=null)
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
                if(isset($remember)) {
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

    private function checkHome($home)
    {
        $home = htmlentities($home, ENT_QUOTES, "UTF-8");
        if (strlen($home) > 100) {
            $_SESSION['errorUser'] = ["Miejsce zamieszkania ma za dużo znaków"];
        }
    }
    private function checkWork($work)
    {
        $work = htmlentities($work, ENT_QUOTES, "UTF-8");
        if (strlen($work) > 100) {
            $_SESSION['errorUser'] = ["Twoja praca ma za dużo znaków"];
        }
    }
    private function checkSchool($school)
    {
        $school = htmlentities($school, ENT_QUOTES, "UTF-8");
        if (strlen($school) > 100) {
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
        if (strlen($about) <= 10) {
            $_SESSION['errorUser'] = ["Opis ma za mało znaków min. 10"];
        }
    }
    public function editProfil($birth = null, $home = null, $worked = null, $school = null, $phone = null, $about = null)
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

    public function changePass($passOld = null, $pass1 = null, $pass2 = null)
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
    private function checkName($name)
    {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if (strlen($name) > 50) {
            $_SESSION['errorUser'] = ["Nazwa ma za dużo znaków"];
        }
    }
    private function checkDescribe($describe)
    {
        $describe = htmlentities($describe, ENT_QUOTES, "UTF-8");
        if (strlen($describe) > 300) {
            $_SESSION['errorUser'] = ["Opis strony ma za dużo znaków"];
        }
    }
    private function checkType($type)
    {
        $question = \Connect\Connect::connect()->prepare("SELECT id FROM type_site WHERE id=:id");
        $question->bindValue(':id', $type, PDO::PARAM_INT);
        $question->execute();
        $result = $question->fetch();
        if ($question->rowCount() == 0) {
            $_SESSION['errorUser'] = ["Nie ma takiej Kategorii"];
        }
        if ($type == "null") {
            $_SESSION['errorUser'] = ["Wybierz kategorię!"];
        }
    }

    public function newSite($name = null, $describe = null, $type = null)
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
            }
        }

    }
    public function showMySite()
    {
        $sql = "SELECT name, idsite FROM sites WHERE admin=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();

        foreach ($question as $value) {
            $id = $value['idsite'];
            echo '<tr>
            <td>
                <a href="page?id='.$id.'">'.$value['name'].'</a>
            </td>
            <td>
                <i class="fa fa-trash-o" title="Usuń Stronę"></i>
            </td>
            <td>
                <i class="fa fa-cog" title="Edytuj Stronę"></i>
            </td>
        </tr>';
        }
    }
    private function checkNameSaved($name)
    {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if (strlen($name) > 50) {
            $_SESSION['errorUser'] = ["Nazwa jest zbyt długa!"];
        }
    }
    private function checkUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $_SESSION['errorUser'] = ["Niepoprawny adres URL strony!"];
        }
    }

    public function addSave($name = null, $url = null)
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
    public function showSaved()
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
                <a href="zapisane?del=' . $id . '"><i class="fa fa-trash-o" title="Usuń"></i></a>
            </td>
        </tr>';
        }


    }
    public function deleteSaved($idsave)
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
        }
    }

    public function showSearchFriend()
    {
        $question = \Connect\Connect::connect()->prepare("SELECT id, name, surname FROM users WHERE not id=:id");
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $fullname = $value['name'] . " " . $value['surname'];
            $id = $value['id'];
            $linkToProfile = "profile?id=$id";
            echo '<div class="col-lg-3 col-md-3 col-sm-3">
            <h5 class="center-text"><a href="' . $linkToProfile . '">' . $fullname . '</a></h5>
            <form method="post">
                <button type="submit" name="addFriend" value="' . $id . '" class="btn btn-success center-block"><i class="fa fa-user-plus"></i></button>
            </form>
        </div>';
        }
    }
    public function checkFriend($idFriend)
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
    public function sendFriend($idfriend)
    {
        $sql = "INSERT INTO friendrequest VALUES(NULL,:id, :idFriend, 0)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public function acceptFriend($idfriend)
    {
        $sql = "UPDATE friendrequest SET status=1 WHERE fromUser=:idFriend AND toUser=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public function deleteFriend($idfriend)
    {
        $sql = "DELETE FROM friendrequest WHERE fromUser=:idFriend AND toUser=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public function ignoreFriend($idfriend)
    {
        $sql = "DELETE FROM friendrequest WHERE fromUser=:idFriend AND toUser=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public function cancelFriend($idfriend)
    {
        $sql = "DELETE FROM friendrequest WHERE fromUser=:id AND toUser=:idFriend";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idFriend', $idfriend, PDO::PARAM_STR);
        $question->execute();
    }
    public function yourRequestFriend()
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

    public function chatright()
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
    public function sendMessage($message,$idToSent)
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
    public function showMessages($idToSent)
    {
        $sql = "SELECT m.fromUser, m.toUser, m.text FROM messages as m, users as u WHERE ((m.toUser=:id AND m.fromUser=:idToSent) OR (m.toUser=:idToSent AND m.fromUser=:id)) AND u.id=(m.fromUser OR m.toUser)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':idToSent', $idToSent, PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $text = $value['text'];

            if($value['fromUser'] == $_SESSION['iduser']) {
                echo '<div class="alert alert-success">
                        '.$text.'
                    </div>';
            } else {
                    echo '<div class="alert alert-info">
                   '.$text.'
                </div>';
                }
        }

    }
    public function showLastMessage()
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

    private function checkNameGroup($name)
    {
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        if (strlen($name) > 300) {
            $_SESSION['errorUser'] = ["Nazwa strony jest za długa"];
        }
        if (strlen($name) < 3) {
            $_SESSION['errorUser'] = ["Nazwa strony jest za krótka"];
        }
    }
    private function addMemberGroup($friends, $id)
    {
//        Dodanie administatora strony
        $sql = "INSERT INTO membersgroup VALUES(NULL,:id,:admin)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':admin', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($friends as $value) {
//          Dodanie pozostałych członków
            $sql = "INSERT INTO membersgroup VALUES(NULL,:id,:member)";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->bindValue(':member', $value, PDO::PARAM_STR);
            $question->execute();
        }
    }
    private function checkStatus($status)
    {
        if ($status == 'Publiczna') return $check = 1;
        elseif ($status == 'Niepubliczna') return $check = 2;
        elseif ($status == 'Prywatna') return $check = 3;
        else $_SESSION['errorUser'] = ["Zaznacz poprawnie status grupy"];
    }
    public function addGroup($name=null, $status=null, $friends=null )
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
            $question->bindValue(':status', $status, PDO::PARAM_STR);
            $question->execute();
            $sql = "SELECT id FROM groups WHERE admin=:admin ORDER BY id DESC LIMIT 1";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':admin', $_SESSION['iduser'], PDO::PARAM_STR);
            $question->execute();
            $result = $question->fetch();
            \User\User::addMemberGroup($friends,$result['id']);
            $_SESSION['success'] = "Grupa została utworzona. Przejdź do zakładki moje grupy, aby przejść dalej :)";
        }
    } //niedokończone
    public function showMyGroup()
    {
        $sql = "SELECT nameGroup, id FROM groups WHERE admin=:id";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();

        foreach ($question as $value) {
            $id = $value['id'];
            echo '<tr>
            <td>
                <a href="grupa?id='.$id.'">'.$value['nameGroup'].'</a>
            </td>
            <td>
                <i class="fa fa-trash-o" title="Usuń Stronę"></i>
            </td>
            <td>
                <i class="fa fa-cog" title="Edytuj Stronę"></i>
            </td>
        </tr>';
        }
    }
    public function showStatusGroup($status)
    {
        if ($status == '1') $check = "Publiczna";
        elseif ($status == '2') $check = "Niepubliczna";
        elseif ($status == '3') $check = "Prywatna";
        else $check = "Błąd";
        return $check;
    }
    public function showCountMembersGroup($id)
    {
        $question = \Connect\Connect::connect()->prepare("SELECT id FROM membersgroup");
        $question->bindValue(':id', $id, PDO::PARAM_STR);
        $question->execute();
        $count = $question->rowCount();
        echo "$count Członków";
    }

    private function checkTextPost($text)
    {
        $text = htmlentities($text, ENT_QUOTES, "UTF-8");
        if (strlen($text) > 3000) {
            $_SESSION['errorUser'] = ["Post ma za dużo znaków"];
        }
        if (strlen($text) < 5) {
            $_SESSION['errorUser'] = ["Post musi mieć co najmniej 5 znaków"];
        }
    }
    public function addPost($typeAutor=null,$text=null)
    {
        \User\User::checkTextPost($text);
        $sql = "INSERT INTO posts VALUES(NULL,:typeAutor,:idautor,:text,now(),1)";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':typeAutor', $typeAutor, PDO::PARAM_STR);
        $question->bindValue(':idautor', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->bindValue(':text', $text, PDO::PARAM_STR);
        $question->execute();
    }
    public function showPost()
    {
        $sql = "SELECT u.id as idUser, u.name, u.surname, p.id as idPost, p.text, p.data FROM posts as p, users as u WHERE u.id=p.idAutor";
        $question = \Connect\Connect::connect()->query($sql);
        foreach ($question as $value) {
            $fullname = $value['name']." ".$value['surname'];
            $data = $value['data'];
            $text = $value['text'];
            $idPost = $value['idPost'];

            echo '<div class="col-lg-12">
        <h4>'.$fullname.'<small>'.$data.'</small></h4>
        <p>'.$text.'</p>
        <p><a class="btn btn-secondary" href="post?id='.$idPost.'" role="button">Zobacz »</a></p>
        <div class="optionsPost">
          <button type="button" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i>Polub</button>
          <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i>Nie lubię</button>
          <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-comment"></i>Komentarz</button>
          <button type="button" class="btn btn-info btn-xs"><i class="fa fa-hand-paper-o"></i>Zgłoś</button>
        </div>
      </div>';
        }

    }//niedokończone
}