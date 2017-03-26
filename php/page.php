<?php
include_once 'errors.php';
include_once 'connect.php';
session_start();
/**
* Obsługa całej strony
*/
class Page extends Connect
{
	public function youlogged()
	{
		if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
			header('Location: welcome');
			exit();
		}
	}
	public function login($emailLogin=null, $password=null)
	{
		$this->emailLogin = $emailLogin;
		$emailLogin = htmlentities($emailLogin, ENT_QUOTES, "UTF-8");
		$this->password = $password;
		$sql = "SELECT * FROM users WHERE email='$this->emailLogin'";
		$question = $this->connect()->query($sql);
		$count = $question->RowCount();
		if ($count > 0) {
			$result = $question->fetch();
	      	if(password_verify($password, $result['password']))
	      	{
				$_SESSION['logged'] = true;
				$_SESSION['iduser'] = $result['id'];
				$_SESSION['name'] = $result['name'];
				$_SESSION['surname'] = $result['surname'];
				$_SESSION['fullName'] = $_SESSION['name']." ".$_SESSION['surname'];

				unset($_SESSION['errorLogin']);
				header('location: main');

	      	} else {
				$_SESSION['errorLogin'] = ["Nie znaleziono użytkownika o takim loginie i haśle!"];
			}
		} else {
			$_SESSION['errorLogin'] = ["Nie znaleziono użytkownika o takim loginie i haśle!"];
		}
	}
}