<?php

	class T_EMPTY {
		public function __call($method, $args) {
			if(isset($this->$method) && is_callable($this->$method)) {
				return call_user_func_array(
					$this->$method, 
					$args
				);
			}
		}
	}

	$scope = new T_EMPTY;
		// #	instantiate global scope
	
	$scope->config = array(
		'path' => $_SERVER['DOCUMENT_ROOT'],
	);
		set_include_path ( $scope->config['path'] );

	$scope->service = new T_EMPTY;
	
	$scope->service->injector = new T_EMPTY;
		$scope->service->injector->inject = function($rsc) {
			global $scope;
			if( is_array( $rsc ) && count( $rsc ) >= 1 ):
				foreach( $rsc as $r ):
					require_once( $scope->config['path'] . '/server/services/' . $r . '.php' );
				endforeach;
			else:
				require_once( $scope->config['path'] . '/server/services/' . $rsc . '.php' );
			endif;
		};

		$injector = & $scope->service->injector;