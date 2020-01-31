<?php
class Model extends PDO{
	private $dsm = 'mysql:dbname=oblig;host=localhost;charset=UTF8';
	private $user = 'oblig';
	private $pw = '';
	public function __construct(){
		parent::__construct($this->dsm,$this->user,$this->pw);
		}
}
?>
