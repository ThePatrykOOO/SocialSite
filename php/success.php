<?php
namespace User;

use User\Success as Success;
class Success
{
    protected function readSuccess($success)
    {
        echo '<div class="panel panel-success">
                      <div class="panel-heading">Udana Operacja!</div>
                      <div class="panel-body">';
        echo $success;
        echo '</div></div>';
    }
    public function successShow($success = null)
    {
        \User\Success::readSuccess($success);
    }
}