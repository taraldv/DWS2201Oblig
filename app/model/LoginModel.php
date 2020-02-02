<?php
class LoginModel extends Model{

	/* Reads user data for specific email, creates session if valid password */
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

	/* Create new user data */
	public function register($email,$password,$token){
		$hash = password_hash($password,PASSWORD_DEFAULT);
		$stmt = $this->prepare("INSERT INTO users (email,hash,token) VALUES (:email,:hash,:token);");
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':hash',$hash);
		$stmt->bindParam(':token',$token);
		return $stmt->execute();
	}

	/* Update user verified and token for specific token */
	public function validEmail($token){
		$stmt = $this->prepare("UPDATE users SET verified = TRUE, token = NULL WHERE token = :token;");
		$stmt->bindParam(':token',$token);
		return $stmt->execute();	
	}

	/* Update user token for specific email */
	public function setNewToken($email,$token){
		$stmt = $this->prepare("UPDATE users SET token = :token WHERE email = :email;");
		$stmt->bindParam(':token',$token);
		$stmt->bindParam(':email',$email);
		return $stmt->execute();
	}

	/* Update user password for specific token */
	public function updatePassword($token,$password){
		$hash = password_hash($password,PASSWORD_DEFAULT);
		$stmt = $this->prepare("UPDATE users set hash = :hash WHERE token = :token;");
		$stmt->bindParam(':hash',$hash);
		$stmt->bindParam(':token',$token);
		return $stmt->execute();
	}
}
?>
