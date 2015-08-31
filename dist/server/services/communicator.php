<?php

	global $scope;
		$scope->service->communicator = new T_EMPTY;
	
	$scope->service->communicator->error = function($msg) {
		$error = json_encode(array(
			'error' => $msg
		));
		exit( $error );
	};

	$scope->service->communicator->result = function($data) {
		exit( json_encode( $data ) );
			/**
			  * assume passed array of data
			  
			  $data = array(
			  	'time' => time()
			  );
			  
			  =
			  
			  { 'data': DateTime }
			  
			*/
	};