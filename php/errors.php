<?php
/** Błędy ze stron */
namespace Error;
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
    public function showErrors($error = null)
    {
        Error::readError($error);
    }
}