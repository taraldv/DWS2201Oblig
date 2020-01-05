<?php
class Workout_controller extends Controller{
	public function index(){
		$this->model('workout_model');
		$this->view('workout'.'/'.'index.php');
		$this->view->render();
	}
	public function add(){
		$this->model('workout_model');
		$selects = $this->model->getWorkouts();
		$this->view('workout'.'/'.'add.php',$selects);
		$this->view->render();
	}
	public function log(){
		$this->model('workout_model');
		$selects = $this->model->getWorkouts();
		$logHistory = $this->model->getLog();
		$this->view('workout'.'/'.'log.php',[$selects,$logHistory]);
		$this->view->render();
	}
	public function log_post(){
		$this->model('workout_model');
		if($_POST['kilo']){
			$this->model->logWorkout($_POST);
		}
		if($_POST['logId']){
			$this->model->deleteLog($_POST['logId']);
		}
		$selects = $this->model->getWorkouts();
		$logHistory = $this->model->getLog();
		$this->view('workout'.'/'.'log.php',[$selects,$logHistory]);
		$this->view->render();

	}
	public function add_post(){	
		$this->model('workout_model');
		$name = $_POST['name'];
		$this->model->addWorkout($name);
		$selects = $this->model->getWorkouts();
		$this->view('workout'.'/'.'add.php',$selects);
		$this->view->render();
	}
}
