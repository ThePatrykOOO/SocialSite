<?php
include_once 'connect.php';
include 'errors.php';
/**
* Rejestracja nowego użytkownika
*/
class SignUp extends Connect
{
	private $name = null;
	private $surname = null;
	private $birth = null;
	private $email = null;
	private $password = null;
	public function checkName($name)
	{
		$check = '/[a-ząęółśżźćń]+$/';
	    if(!preg_match($check, $name)) {
	      	$_SESSION['errorRegister'] = ['Podane imie jest niepoprawne!'];
	    }	
	    if(strlen($name) > 50) {
	    	$_SESSION['errorRegister'] = ["Imie ma za dużo znaków"];
	    }
	    if(strlen($name) < 3) {
	    	$_SESSION['errorRegister'] = ["Imie ma za mało znaków"];
	    }
	}
	public function checkSurname($surname)
	{
		$check = '/[a-ząęółśżźćń]+$/';
	    if(!preg_match($check, $surname)) {
	      	$_SESSION['errorRegister'] = ["Podane nazwisko jest niepoprawne!"];
	    }
	    if(strlen($surname) > 50) {
	    	$_SESSION['errorRegister'] = ["Nazwisko ma za dużo znaków"];
	    }
	    if(strlen($surname) < 3) {
	    	$_SESSION['errorRegister'] = ["Nazwisko ma za mało znaków"];
	    }
	}
	public function checkBirth($birth)
	{
		if ($birth < checkdate(01, 01, 1920) and $birth < checkdate(31, 12, 2010)) {
			$_SESSION['errorRegister'] = ["Podana data jest niepoprawna"];
		}
	}
	public function checkEmail($email)
	{
		$emailSafe = filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($emailSafe, FILTER_VALIDATE_EMAIL)==false) || $emailSafe != $email) {
			$_SESSION['errorRegister'] = ["Podałeś niepoprawną datę"];
		}	    
		$sql = "SELECT email FROM users WHERE email='$email'";
		$question = Connect::connect()->query($sql);
	    $count = $question->RowCount();
	    if($count>0) {
	      	$_SESSION['errorRegister'] = ["Email jest już zajęty!"];
	    }
	    if(strlen($email) > 200) {
	    	$_SESSION['errorRegister'] = ["Email ma za dużo znaków"];
	    }
	}
	public function checkPassword($password)
	{
		if((strlen($password)<5) || (strlen($password)>20)) {
			$_SESSION['errorRegister'] = ["Hasło powinno zawierać od 5 do 20 znaków."];
		}
		$password_hash = password_hash($password, PASSWORD_BCRYPT);
		return $password_hash;
	}
	public function register($name=null, $surname=null, $birth=null, $email=null, $password=null)
	{ 
		$this->name = $name;
		$this->checkName($name);
		$this->surname = $surname;
		$this->checkSurname($surname);
		$this->birth = $birth;
		$this->checkBirth($birth);
		$this->email = $email;
		$this->checkEmail($email);
		$this->password = $password;
		$password_hash = $this->checkPassword($password);
		// Wszystko jest OK można rejestrować usera.
		if (!isset($_SESSION['errorRegister']) || count($_SESSION['errorRegister']) == 0) {
			$sql = "INSERT INTO users VALUES(NULL,'$this->name','$this->surname','$this->email','$password_hash','$this->birth',NULL,NULL,NULL,NULL,NULL,0)";
			$question = $this->connect()->query($sql);
			if ($question) {
				echo "YES";
			} else {
				echo "NO";
			}

		}
	}
}