<?php
/**
* Połączenie się z bazą
*/
class Connect
{
	public function connect()
	{
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";
		$this->dbname = "social";
		try {
			$pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo "Błąd z połączeniem się z bazą";
			//echo $e->getMessage();
			exit();
		}
		return $pdo;
	}
}
?>