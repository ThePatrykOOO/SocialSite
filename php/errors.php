<?php
/**
 * Błędy ze stron
 */
namespace Error;
include 'success.php';
use User\Success;
use Error\Error;
class Error
{
	protected function readError($error)
	{
		echo '<div class="panel panel-danger">
                      <div class="panel-heading">Wystąpiły błędy!</div>
                      <div class="panel-body">';
		foreach ($error as $value) echo $value;
		echo '</div></div>';
	}
	public function showErrorsRegister($error = null)
	{
        \Error\Error::readError($error);
	}
	public function showErrorsLogin($error = null)
	{
        \Error\Error::readError($error);
	}
    public function showErrorsUser($error = null)
    {
        \Error\Error::readError($error);
    }
}