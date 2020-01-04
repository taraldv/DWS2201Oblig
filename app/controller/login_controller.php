<?php
class Login_controller extends Controller{


	public function index(){
		$this->model('login_model');
		$this->view('login'.'/'.'index.php',$this->model);
		$this->view->render();	
	}

	public function register(){
		$this->model('login_model');
		$this->view('login'.'/'.'register.php',$this->model);
		$this->view->render();	
	}

	public function index_post(){
		$this->model('login_model');
		$this->view('login'.'/'.'index.php',$this->model);
		$this->view->render();	
	}

	public function register_post(){
		$this->model('login_model');
		$this->view('login'.'/'.'test.php',$this->model);
		$this->view->render();	
	}
}
?>
