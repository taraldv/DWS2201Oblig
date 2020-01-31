<?php
class View{
	protected $viewFile;
	protected $viewData;

	public function __construct($viewFile,$viewData){
		$this->viewFile = $viewFile;
		$this->viewData = $viewData;
	}

	public function render(){
		if(file_exists(VIEW.$this->viewFile)){
			include VIEW.$this->viewFile;	
		}
	}

	public function getMethod(){
		return (explode('/',$this->viewFile)[1]);
	}
}
