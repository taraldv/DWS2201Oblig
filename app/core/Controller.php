<?php
abstract class Controller{
	protected $view;
	protected $model;
	public function view($viewName,$data=[]){
		$this->view = new View($viewName,$data);
	}
	public function model($modelName){
		$this->model = new $modelName;
	}
}
