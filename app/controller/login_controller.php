<?php
class Login_controller extends Controller{


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

	public function index_post(){
		$this->model('login_model');
		$email = $_POST['email'];
		$password = $_POST['password'];
		$valid = $this->model->valid($email,$password);
		$this->view('login'.'/'.'index.php',[$valid]);
		$this->view->render();	
	}

	public function register_post(){
		$this->model('login_model');
		$email = $_POST['email'];
		$password = $_POST['password'];
		$inUse = $this->model->register($email,$password);
		$this->view('login'.'/'.'register.php',[$inUse]);
		$this->view->render();	
	}
}
?>
