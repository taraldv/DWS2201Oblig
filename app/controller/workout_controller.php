<?php
class Workout_controller extends Controller{
	public function index(){
		$this->model('workout_model');
		$selects = $this->model->getWorkouts();
		$logHistory = $this->model->getLog();
		$this->view('workout'.'/'.'index.php',[$selects]);
		$this->view->render();
	}
	public function get_specific_workout(){
		$this->model('workout_model');
		$workoutId = $_POST['id'];
		$dataArray = $this->model->getSpecificLogHistory($workoutId);
		echo (json_encode($dataArray));
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
		$name = $_POST['name'];
		$kilo = $_POST['kilo'];
		$reps = $_POST['reps'];
		$workoutId = $_POST['workoutId'];
		$lastInsertArray = $this->model->logWorkout($kilo,$reps,$workoutId);
		if($lastInsertArray){
			$name = $lastInsertArray['name'];
			$reps = $lastInsertArray['reps'];
			$kilo = $lastInsertArray['kilo'];
			$date = $lastInsertArray['date'];
			$id = $lastInsertArray['id'];
			$element = "<tr><td>$name</td><td>$reps</td><td>$kilo</td><td>$date</td><td><button data=$id class='deleteButton btn btn-block btn-secondary'>Slett</button></td></tr>";
			echo "{\"element\":\"$element\",
			\"idType\":\"logId\",
			\"divClass\":\"deleteButton\",
			\"url\":\"delete_log\"}";
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
			$element = "<tr><td>$name</td><td><button class='deleteButton btn btn-block btn-secondary' data=$lastInsertId>Slett</button></td></tr>";
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
