<?php
namespace User;
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
    public function showFriendGroup()
    {
        $sql = "SELECT u.id, u.name, u.surname FROM friendrequest as f, users as u WHERE (f.fromUser=:id OR f.toUser=:id) AND u.id!=:id AND f.status=1";
        $question = \Connect\Connect::connect()->prepare($sql);
        $question->bindValue(':id', $_SESSION['iduser'], PDO::PARAM_STR);
        $question->execute();
        foreach ($question as $value) {
            $fullname = $value['name'] . " " . $value['surname'];
            $id = $value['id'];
            echo '<input type="checkbox" name="FriendGroup[]" value="'.$id.'">'.$fullname.'<br>';
        }
    }
}