<?php
namespace Page;
use PDO;
class Page extends \Connect\Connect
{
    public function showTypeSite()
    {
        $question = \Connect\Connect::connect()->query("SELECT * FROM type_site");
        foreach ($question as $key => $result) {
            $name = $result['name_type'];
            echo "<option value='$key'>$name</option>";
        }
    }
    public function showFriendGroup($id=null)
    {
        $sql = "SELECT u.id, u.name, u.surname FROM friendrequest as f, users as u WHERE (f.fromUser=:id OR f.toUser=:id) AND u.id!=:id AND f.status=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $fullname = $value['name'] . " " . $value['surname'];
            $idUser = $value['id'];
            $sql = "SELECT id FROM membersgroup WHERE iduser=:idUser AND idgroup=:id";
            $question = \Connect\Connect::connect()->prepare($sql);
            $question->bindValue(':idUser', $idUser, PDO::PARAM_STR);
            $question->bindValue(':id', $id, PDO::PARAM_STR);
            $question->execute();
            $count = $question->rowCount();
            if ($count == 0) {
                echo '<input type="checkbox" name="FriendGroup[]" value="'.$idUser.'">'.$fullname.'<br>';
            }
        }
    }
    public function checkInfoCookie()
    {
        if (!isset($_COOKIE)) {
            echo '<div class="alert alert-success alert-dismissable fade in navbar-fixed-bottom" style="margin: 0">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Szybkie info</strong> Strona ta używa ciasteczek 
  </div>';
        }

    }
    public static function addJS()
    {
        if ($_SERVER['SCRIPT_NAME'] == "/social/user/messages.php") {
            echo '<script src="../js/message.js"></script>';
        }

    }
}