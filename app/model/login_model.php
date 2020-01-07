<?php
class Login_model extends Model{
	public function validLogin($email,$password){
		$stmt = $this->prepare("SELECT userId,hash,verified FROM users WHERE email = :email;"); 
		$stmt->bindParam(':email',$email);
		$stmt->execute();
		$arr = $stmt->fetch(PDO::FETCH_ASSOC);
		$hash = $arr['hash'];
		$id = $arr['userId'];
		$verified = $arr['verified'];
		if($verified && password_verify($password,$hash)){
			session_start();
			$_SESSION['email']=$email;
			$_SESSION['id']=$id;
			return true;
		} else {
			return false;
		}
	}

	public function register($email,$password,$token){
		$hash = password_hash($password,PASSWORD_DEFAULT);
		$stmt = $this->prepare("INSERT INTO users (email,hash,token) VALUES (:email,:hash,:token);");
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':hash',$hash);
		$stmt->bindParam(':token',$token);
		return $stmt->execute();
	}

	public function validEmail($token){
		$stmt = $this->prepare("UPDATE users SET verified = TRUE,token='' WHERE token = :token;");
		$stmt->bindParam(':token',$token);
		return $stmt->execute();	
	}

	public function setNewToken($email,$token){
		$stmt = $this->prepare("UPDATE users SET token = :token WHERE email = :email;");
		$stmt->bindParam(':token',$token);
		$stmt->bindParam(':email',$email);
		return $stmt->execute();
	}

	public function updatePassword($token,$password){
		$hash = password_hash($password,PASSWORD_DEFAULT);
		$stmt = $this->prepare("UPDATE users set hash = :hash,token='' WHERE token = :token;");
		$stmt->bindParam(':hash',$hash);
		$stmt->bindParam(':token',$token);
		return $stmt->execute();
	}
}
?>
