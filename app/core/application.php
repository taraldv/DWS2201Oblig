<?php
class Application{
	protected $controller = 'workout_controller';
	protected $action = 'index';
	protected $prams = [];

	public function __construct(){
		$this->prepareURL();
		$this->checkSession();
		if(file_exists(CONTROLLER.$this->controller.'.php')){
			$this->controller = new $this->controller;
			#var_dump($this->controller);
			#var_dump($this->action);
			#var_dump($_SESSION);
			if(method_exists($this->controller,$this->action)){
				//for eksempel hvis /login/ besøkes
				//kjøres index funksjonen i login controller
				call_user_func_array([$this->controller,$this->action],$this->prams);
			}
		}
	}

	protected function prepareURL(){
		$request = trim($_SERVER['REQUEST_URI'],'/');
		if(!empty($request)){
			$url = explode('/',$request);
			$this->controller = isset($url[0]) ? $url[0].'_controller':'workout_controller';
			$this->action = isset($url[1]) ? $url[1] : 'index';
			/*if(count($_POST)>0){
				$this->action=$this->action.'_post';
			}*/
			unset($url[0],$url[1]);
			$this->prams = !empty($url) ? array_values($url):[];
		} 
	}

	protected function checkSession(){
		session_start();
		if(!isset($_SESSION['email']) && $this->controller!='login_controller'){
			header('Location: /login');
		}
	}
}
?>
