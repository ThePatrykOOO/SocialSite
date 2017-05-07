<?php
/** Połączenie się z bazą */
namespace Connect;
use PDO;
class Connect
{
	public static function connect()
	{
        try {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "social";

            $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass", [PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'"]);
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