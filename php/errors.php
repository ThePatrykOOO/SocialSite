<?php
/**
* Błędy ze stron
*/
class Errors
{
	protected function readError($error)
	{
		echo '<div class="panel panel-danger">
                      <div class="panel-heading">Wystąpiły błędy!</div>
                      <div class="panel-body">';
		for ($i = 0; $i < count($error); $i++) {
			echo $error[$i];
		}
		echo '</div></div>';
	}
	public function showErrorsRegister($error = null)
	{
		$this->readError($error);
	}
	public function showErrorsLogin($error = null)
	{
		$this->readError($error);
	}
}