<?php
class WorkoutController extends Controller{

	/* GET request, sends data for select elements to view*/
	public function index(){
		$this->model('WorkoutModel');
		$selects = $this->model->getWorkouts();
		$this->view('workout'.'/'.'index.php',[$selects]);
		$this->view->render();
	}

	/* GET request, sends data for table elements to view*/
	public function add(){
		$this->model('WorkoutModel');
		$selects = $this->model->getWorkouts();
		$this->view('workout'.'/'.'add.php',$selects);
		$this->view->render();
	}

	/* GET request, sends data for select and table elements to view*/
	public function log(){
		$this->model('WorkoutModel');
		$selects = $this->model->getWorkouts();
		$logHistory = $this->model->getLog();
		$this->view('workout'.'/'.'log.php',[$selects,$logHistory]);
		$this->view->render();
	}

	/* POST request, returns log data to a specific excercise*/
	public function get_specific_workout(){
		$this->model('WorkoutModel');
		$workoutId = $_POST['id'];
		$dataArray = $this->model->getSpecificLogHistory($workoutId);
		echo (json_encode($dataArray));
	}

	/* POST request, inserts log data and returns data for javascript to append */
	public function add_log(){
		$this->model('WorkoutModel');
		$name = $_POST['name'];
		$kilo = $_POST['kilo'];
		$reps = $_POST['reps'];
		$workoutId = $_POST['workoutId'];
		$lastInsertArray = $this->model->logWorkout($kilo,$reps,$workoutId);
		if($lastInsertArray){
			echo (json_encode($lastInsertArray));
		} else {
			echo '0';
		}
	}

	/* POST request, deletes log data, returns 1 or 0 */
	public function delete_log(){
		$this->model('WorkoutModel');
		$successfullyDeleted = $this->model->deleteLog($_POST['logId']);
		echo "$successfullyDeleted";
	}

	/* POST request, inserts new excercise and returns data for javascript to append */
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

	/* POST request, deletes specific excercise, returns 1 or 0 */
	public function delete_workout(){	
		$this->model('WorkoutModel');
		$successfullyDeleted = $this->model->deleteWorkout($_POST['workoutId']);
		echo "$successfullyDeleted";
	}
}
