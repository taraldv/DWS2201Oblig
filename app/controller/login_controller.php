<?php
class Login_controller extends Controller{
	public function logout(){
		session_destroy();
		header("Location: /");	
	}

	public function index(){
		$this->model('login_model');
		$this->view('login'.'/'.'index.php',[TRUE]);
		$this->view->render();	
	}

	public function register(){
		$this->model('login_model');
		$this->view('login'.'/'.'register.php',[TRUE]);
		$this->view->render();	
	}

	public function valid_login(){
		$this->model('login_model');
		$email = $_POST['email'];
		$password = $_POST['password'];
		$valid = $this->model->valid($email,$password);
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
		$successfullyAdded = $this->model->register($email,$password);
		if($successfullyAdded){
			header("Location: /login");
		} else {
			$this->view('login'.'/'.'register.php',[$successfullyAdded]);
			$this->view->render();	
		}
	}
}
?>
