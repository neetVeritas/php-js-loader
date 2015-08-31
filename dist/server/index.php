<?php

	error_reporting(0);
		// #	disable error reporting

	require_once( 'inc.init.php' );
		global $scope, $injector;
			$injector->inject('communicator');
		// #	initialize scope

	$communicator = & $scope->service->communicator;
		// #	instantiate communicator service
	
	$module = new T_EMPTY;
	$module->about = (object) array(
		'name' => $_GET['module'],
		'mdir' => $scope->config['path'] . '/server/modules/' . $_GET['module'] . '/',
	);

	switch( $module->about->name ) {
		case 'loader':
			require_once( $module->about->mdir . 'module.php' );
				$module->init();
			break;
		default:
			$communicator->error('Module Does Not Exist');
			break;
	}

	$communicator->error('Module Not Specified');