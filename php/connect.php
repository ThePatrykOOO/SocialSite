<?php
/**
* Połączenie się z bazą
*/
namespace Connect;
use PDO;
class Connect
{
	public function connect()
	{
		$host = "localhost";
		$user = "root";
		$pass = "";
		$dbname = "social";
		try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass");
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