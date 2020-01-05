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

	public function add_log(){
		$this->model('workout_model');
		$successfullyAdded = $this->model->logWorkout($_POST);
		if($successfullyAdded){
		} else {
			echo '0';
		}
	}
	public function delete_log(){
		$this->model('workout_model');
		$successfullyDeleted = $this->model->deleteLog($_POST['logId']);
		echo "$successfullyDeleted";
	}
	public function add_workout(){	
		$this->model('workout_model');
		$name = $_POST['name'];
		$lastInsertId = $this->model->addWorkout($name);
		if(isset($lastInsertId)){
			$element = "<tr><td>$name</td><td><div class='deleteButton' data=$lastInsertId>Slett</div></td></tr>";
			echo "{\"element\":\"$element\",
			\"idType\":\"workoutId\",
			\"divClass\":\"deleteButton\",
			\"url\":\"delete_workout\"}";
		} else {
			echo '0';
		}
	}
	public function delete_workout(){	
		$this->model('workout_model');
		$successfullyDeleted = $this->model->deleteWorkout($_POST['workoutId']);
		echo "$successfullyDeleted";
	}
}
