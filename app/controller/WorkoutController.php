<?php
class WorkoutController extends Controller{
	public function index(){
		$this->model('WorkoutModel');
		$selects = $this->model->getWorkouts();
		$logHistory = $this->model->getLog();
		$this->view('workout'.'/'.'index.php',[$selects]);
		$this->view->render();
	}
	public function get_specific_workout(){
		$this->model('WorkoutModel');
		$workoutId = $_POST['id'];
		$dataArray = $this->model->getSpecificLogHistory($workoutId);
		echo (json_encode($dataArray));
	}
	public function add(){
		$this->model('WorkoutModel');
		$selects = $this->model->getWorkouts();
		$this->view('workout'.'/'.'add.php',$selects);
		$this->view->render();
	}
	public function log(){
		$this->model('WorkoutModel');
		$selects = $this->model->getWorkouts();
		$logHistory = $this->model->getLog();
		$this->view('workout'.'/'.'log.php',[$selects,$logHistory]);
		$this->view->render();
	}

	public function add_log(){
		$this->model('WorkoutModel');
		$name = $_POST['name'];
		$kilo = $_POST['kilo'];
		$reps = $_POST['reps'];
		$workoutId = $_POST['workoutId'];
		$lastInsertArray = $this->model->logWorkout($kilo,$reps,$workoutId);
		if($lastInsertArray){
			echo (json_encode($lastInsertArray));
			/*$name = $lastInsertArray['name'];
			$reps = $lastInsertArray['reps'];
			$kilo = $lastInsertArray['kilo'];
			$date = $lastInsertArray['date'];
			$id = $lastInsertArray['id'];
			$element = "<tr><td>$name</td><td>$reps</td><td>$kilo</td><td>$date</td><td><button data=$id class='deleteButton btn btn-block btn-secondary'>Slett</button></td></tr>";
			echo "{\"element\":\"$element\",
			\"idType\":\"logId\",
			\"divClass\":\"deleteButton\",
			\"url\":\"delete_log\"}";*/
		} else {
			echo '0';
		}
	}
	public function delete_log(){
		$this->model('WorkoutModel');
		$successfullyDeleted = $this->model->deleteLog($_POST['logId']);
		echo "$successfullyDeleted";
	}
	public function add_workout(){	
		$this->model('WorkoutModel');
		$name = $_POST['name'];
		$lastInsertId = $this->model->addWorkout($name);
		$dataArray = array("name"=>$name,"id"=>$lastInsertId);
		if(isset($lastInsertId)){
			echo (json_encode($dataArray));
		} else {
			echo '0';
		}
	}
	public function delete_workout(){	
		$this->model('WorkoutModel');
		$successfullyDeleted = $this->model->deleteWorkout($_POST['workoutId']);
		echo "$successfullyDeleted";
	}
}
