<?php
class Application{
	protected $controller = 'WorkoutController';
	protected $action = 'index';

	public function __construct(){
		$this->prepareURL();
		$this->controller = ucfirst($this->controller);
		$this->checkSession();
		/* If the controller is a valid php file, create new object */
		if(file_exists(CONTROLLER.$this->controller.'.php')){
			$this->controller = new $this->controller;
			/* If the action is a valid method in the new object, run the method */
			if(method_exists($this->controller,$this->action)){
				call_user_func_array([$this->controller,$this->action]);
			}
		}
	}

	/* Splits URL into controller object and controller function. Updates variables if they exist.  */
	protected function prepareURL(){
		$request = trim($_SERVER['REQUEST_URI'],'/');
		if(!empty($request)){
			$url = explode('/',$request);
			if(isset($url[0])){
				$this->controller = $url[0].'Controller';
			}
			if(isset($url[1])){
				$this->action =  $url[1];
			}
		} 
	}

	/* Redirects to login if session not set and not visiting a login page */
	protected function checkSession(){
		session_start();
		if(!isset($_SESSION['email']) && $this->controller!='LoginController'){
			header('Location: /login');
		}
	}
}
?>
