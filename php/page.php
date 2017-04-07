<?php
namespace User;

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
}