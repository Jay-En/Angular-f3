<?php
class Model extends DB\SQL\Mapper{
	protected $db;

	function __construct($table){
		

		$this->initializeDatabase();
		parent::__construct($this->db,$table);

	}

	function initializeDatabase(){

		$f3=Base::instance();

		$db = new DB\SQL(
			$f3->get("DBS"),
			$f3->get("dbuser"),
			$f3->get("dbpass")
			);

		$this->db=$db;

	}
	function parse_body(){
		$f3=Base::instance();
		$head=getallheaders();

		switch (true) {
			case (strpos($head['Content-Type'],'application/json')!==false):
				$input=json_decode($f3->get('BODY'));
				break;
			case (strpos($head['Content-Type'],'application/x-www-form-urlencoded;charset=utf-8')!==false):
				 parse_str($f3->get('BODY'),$input);
				break;
			default:
				 parse_str($f3->get('BODY'),$input);
				break;
		}

		$f3->set('INPUT',$input);
	}
}