<?php
class Workout_controller extends Controller{
	public function index(){
		$this->model('workout_model');
		$this->view('workout'.'/'.'index.php',$this->model);
		$this->view->render();
	}
	public function add(){
		$this->model('workout_model');
		$this->view('workout'.'/'.'add.php',$this->model);
		$this->view->render();
	}
	public function change(){
		$this->model('workout_model');
		$this->view('workout'.'/'.'change.php',$this->model);
		$this->view->render();
	}
