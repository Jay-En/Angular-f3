<?php 

class userController extends Controller{

	private $response;

	function index(){
		$this->htmlResponse("Fat Free Site","user/index.html");
	}

	function listUsers($f3){
		$users = new User();
		$result=$users->all();
		if($users->error){
		$this->httpResponse($users->error[code],$users->error);
		}
		else
		{
			$this->httpResponse("200",$result);
		}
	}

	function findOne($f3){
		$users = new User();
		$result=$users->getByID($f3->get('PARAMS.id'));
		if($users->error){
		$this->httpResponse($users->error[code],$users->error);
		}
		else
		{
			$this->httpResponse("200",$result);
		}
	}

	function create($f3){
		$users = new User();
		$result=$users->create();
		if($users->error){
			$this->httpResponse($users->error[code],$users->error);
		}
		else
		{
			$this->httpResponse("200",$result);
		}
	}

	function update($f3){
		$users = new User();
		$result=$users->edit($f3->get('PARAMS.id'));
		if($users->error){
			$this->httpResponse($users->error[code],$users->error);
		}
		else
		{
			$this->httpResponse("200",$result);
		}
	}

	function delete($f3){
		$users = new User($this->db);
		$result=$users->remove($f3->get('PARAMS.id'));
		if($users->error){
			$this->httpResponse($users->error[code],$users->error);
		}
		else
		{
			$this->httpResponse("200",$result);
		}
	}
}