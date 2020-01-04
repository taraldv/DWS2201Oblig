<?php
abstract class Controller{
	protected $view;
	protected $model;

	public function view($viewName,$data=[]){
		$this->view = new View($viewName,$data);
	#return $this->view;

	}

	/*public function oldmodel($modelName){
		if(file_exists(MODEL.$modelName.'.php')){
			require MODEL.$modelName.'.php';
			$this->model = new $modelName;
		}
	}*/

	public function model($modelName){
		$this->model = new $modelName;
	}


}
