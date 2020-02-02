<?php
abstract class Controller{
	protected $model;
	protected $view;
	public function model($modelName){
		$this->model = new $modelName;
	}
	public function view($viewName,$data=[]){
		$this->view = new View($viewName,$data);
	}
}
