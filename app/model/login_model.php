<?php
class Login_model extends Model{
	public function valid($email,$password){
		$stmt = $this->prepare("SELECT userId,hash FROM users WHERE email = :email;"); 
		$stmt->bindParam(':email',$email);
		$stmt->execute();
		$arr = $stmt->fetch(PDO::FETCH_ASSOC);
		$hash = $arr['hash'];
		$id = $arr['userId'];
		if(password_verify($password,$hash)){
			session_start();
			$_SESSION['email']=$email;
			$_SESSION['id']=$id;
			header('Location:../workout/');
		} else {
			return false;
		}
	}

	public function register($email,$password){
		$hash = password_hash($password,PASSWORD_DEFAULT);
		$stmt = $this->prepare("INSERT INTO users (email,hash) VALUES (:email,:hash);");
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':hash',$hash);
		if($stmt->execute()){
			header('Location:../login/');
		} else {
			return false;
		}
	}
}
?>
