<?php
class Model extends PDO{
	protected $db;

	private $dsm = 'mysql:dbname=oblig;host=localhost;charset=UTF8';
	private $user = 'oblig';
	private $pw = '';

	public function __construct(){
		#$this->db = new PDO($this->dsm,$this->user,$this->pw);
		parent::__construct($this->dsm,$this->user,$this->pw);
		}


}

?>
