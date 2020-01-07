<?php
class Login_controller extends Controller{
	public function logout(){
		session_destroy();
		header("Location: /");	
	}

	public function verify($prams){
		$this->model('login_model');
		$update = $this->model->validEmail($prams);
		if($update){
			header("Location: /login");
		} else {
		//TODO feil ved token
		}
	}

	public function send_password_link(){	
		$this->model('login_model');
		$email = $_POST['email'];
		$token = substr(md5(mt_rand()), 0, 100);
		$mail = new Mail('Reset passord til oblig.tarves.no',$email,'/login/new_password');
		$mail->setMailBody('Trykk på linken for å skrive nytt passord',$token,'Link');
		$successfullyAdded = $this->model->setNewToken($email,$token);
		if($successfullyAdded){
			$mail->sendMail();
		}
		echo "$successfullyAdded";
	}

	public function update_password(){
		$this->model('login_model');
		$token = $_POST['token'];
		//Default token er empty string, så den kan ikke være en gyldig POST parameter
		if(empty($token)){
			header("Location: /login/forgotten_password");
			exit;
		};
		$update = $this->model->updatePassword($token,$_POST['password']);
		if($update){
			header("Location: /login");
		} else {
			header("Location: /login/forgotten_password");
		}
	}

	public function new_password($prams){
		$this->model('login_model');
		$this->view('login'.'/'.'new_password.php',$prams);
		$this->view->render();
	}

	public function forgotten_password(){
		$this->model('login_model');
		$this->view('login'.'/'.'password.php');
		$this->view->render();
	}

	public function index(){
		$this->model('login_model');
		$this->view('login'.'/'.'index.php',[TRUE]);
		$this->view->render();	
	}

	public function register(){
		$this->model('login_model');
		$this->view('login'.'/'.'register.php');
		$this->view->render();	
	}

	public function valid_login(){
		$this->model('login_model');
		$email = $_POST['email'];
		$password = $_POST['password'];
		$valid = $this->model->validLogin($email,$password);
		if($valid){
			header("Location: /workout/");
		} else {
			$this->view('login'.'/'.'index.php',[$valid]);
			$this->view->render();	
		}
	}

	public function add_user(){
		$this->model('login_model');
		$email = $_POST['email'];
		$password = $_POST['password'];
		//https://stackoverflow.com/questions/4356289/php-random-string-generator/31107425#31107425
		$token = substr(md5(mt_rand()), 0, 100);
		$mail = new Mail('Oblig.tarves.no epost verifisering',$email,'/login/verify');
		$mail->setMailBody('Trykk på linken for å verifisere epost',$token,'Link');
		$successfullyAdded = $this->model->register($email,$password,$token);
		if($successfullyAdded){
			$mail->sendMail();
		}	
		$this->view('login'.'/'.'register.php',[$successfullyAdded]);
		$this->view->render();	
		
	}
}
?>
