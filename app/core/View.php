<?php
class View{
	
	protected $viewData;
	protected $viewFile;

	public function __construct($viewFile,$viewData){
		$this->viewData = $viewData;
		$this->viewFile = $viewFile;
	}
	public function getMethod(){
		return (explode('/',$this->viewFile)[1]);
	}
	public function render(){
		if(file_exists(VIEW.$this->viewFile)){
			include VIEW.$this->viewFile;	
		}
	}
}
