<?php
class LoginController extends Controller{

	/* Destroy session and redirect to root */
	public function logout(){
		session_destroy();
		header("Location: /");	
	}

	/* GET request without view. Verifies token and redirects */
	public function verify(){
		$token = $_GET['token'];
		$this->model('LoginModel');
		$update = $this->model->validEmail($token);
		header("Location: /login");
	}

	/* POST request, sends email with password reset link. */
	public function send_password_link(){	
		$this->model('LoginModel');
		$email = $_POST['email'];
		//https://stackoverflow.com/questions/4356289/php-random-string-generator/31107425#31107425
		$token = substr(md5(mt_rand()), 0, 100);
		$mail = new Mail('Reset passord til oblig.tarves.no',$email,'/login/new_password');
		$mail->setMailBody('Trykk på linken for å skrive nytt passord',$token,'Link');
		$successfullyAdded = $this->model->setNewToken($email,$token);
		if($successfullyAdded){
			$mail->sendMail();
		}
		echo "$successfullyAdded";
	}

	/* Form POST request, updates password and redirects */
	public function update_password(){
		$this->model('LoginModel');
		$token = $_POST['token'];
		$update = $this->model->updatePassword($token,$_POST['password']);
		if($update){
			header("Location: /login");
		} else {
			header("Location: /login/forgotten_password");
		}
	}

	/* GET request with a token parameter, renders page to update password */
	public function new_password(){
		$token = $_GET['token'];
		if(isset($token)){
			$this->view('login'.'/'.'new_password.php',$token);
			$this->view->render();
		} else {
			header("Location: /login/forgotten_password");
		}
	}

	/* GET request , renders page to write email for password update*/
	public function forgotten_password(){
		$this->view('login'.'/'.'password.php');
		$this->view->render();
	}

	/* GET request, renders page for login */
	public function index(){
		$this->view('login'.'/'.'index.php',[TRUE]);
		$this->view->render();	
	}

	/* GET request, renders page for registering new user */
	public function register(){
		$this->view('login'.'/'.'register.php');
		$this->view->render();	
	}

	/* Form POST request, checks if valid login credentials. Redirects to workout or renders login page. */
	public function valid_login(){
		$this->model('LoginModel');
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

	/* Form POST request, adds new user to database and sends verification email and then renders login page */
	public function add_user(){
		$this->model('LoginModel');
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
