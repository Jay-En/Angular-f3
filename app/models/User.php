<?php 
class User extends Model{

	public $error;

	function __construct(array $user = null){

		parent::__construct("users");
		if($user){
			echo "hello";
		}
	}

	function all(){
		$this->load();
		return $this->toArray();
	}

	function getByID($id){
		$this->load(array('id=?',$id));

		if($this->count(array('id=?',$id))>0){

		$arData=$this->cast();
		unset($arData['password']);
		return $arData;


		}else
		{
		$this->error = array(
				'code' => '404',
				'message' => 'User not found'
				);

		}
	}

	function create(){


	    $this->parse_body();
		$this->copyfrom('INPUT');
		$this->verify();

		if(!$this->error)
		{
		$this->save();
		return $this->cast();
		}else
		{
		return null;
		}
	}

	function edit($id){
		$this->load(array('id=?',$id));

		if($this->count(array('id=?',$id))>0){

	    $this->parse_body();
		$this->copyfrom('INPUT');
		$this->verify();

		if(!$this->error)
		{
			 $this->update();
			
			 return $this->cast();
		}else
		{
		return null;
		}
		}else
		{
		$this->error = array(
				'code' => '404',
				'message' => 'User not found'
				);

		}
	}

	function remove($id){
		$this->load(array('id=?',$id));

		if($this->count(array('id=?',$id))>0){
			$this->erase();

			return array(
				'message' => 'Successfully Deleted.');
		}else
		{
		$this->error = array(
				'code' => '404',
				'message' => 'User not found'
				);

		}
	}



	function verify(){

		switch (true) {
			case ($this->name==null) : 
			$this->error = array(
				'code' => '400',
				'message' => 'name is required'
				);
			break;
			case ($this->password==null) : 
			$this->error = array(
				'code' => '400',
				'message' => 'Password is required'
				);
			break;
			case ($this->address==null) : 
			$this->error = array(
				'code' => '400',
				'message' => 'address is required'
				);
			break;
			case ($this->email==null) : 
			$this->error = array(
				'code' => '400',
				'message' => 'email is required'
				);
			break;
		}
		
	}

	function toArray()
		{

		$arResponse = array();
		
		foreach (($this->query?:array()) as $user) {

			$arData = array();
			$arData['ID'] = $user['id'];
			$arData['name'] = $user['name'];
			$arData['address'] = $user['address'];
			$arData['mobile'] = $user['mobile'];
			$arData['email'] = $user['email'];

			array_push($arResponse, $arData);

		
		}

		return $arResponse;

	}
}