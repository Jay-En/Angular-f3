<?php

Class Controller {

	function httpResponse($status, $body){

		header('HTTP/1.1 '.$status);
		header('Content-Type: application/json');
		echo json_encode($body);
	}

	function htmlResponse($title,$html){
		$f3 = Base::instance();
		$f3->set('title',$title);
		$f3->set('view',$html);
		echo Template::instance()->render("layout.html");
	}


}