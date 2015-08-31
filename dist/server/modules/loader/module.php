<?php

	global $scope, $communicator, $module;
	
	$module->init = function() {
		global $scope, $communicator, $module;
		switch( $_GET['resource'] ) {
			case 'scripts':
				$sources = (array) json_decode( file_get_contents( $module->about->mdir . 'cnf/scripts.json', FILE_USE_INCLUDE_PATH ) );
					$buffer = '';
					foreach( $sources as $name=>$dist ) {
						if( !$dist->enabled ):
							continue;
						else:
						
							foreach( $dist->list as $r ):
								if( !$r->enabled ):
									continue;
								else:
									if( $dist->local ):
										$buffer .= file_get_contents( $scope->config['path'] . $r->source, FILE_USE_INCLUDE_PATH );
									else:
										$buffer .= file_get_contents( $r->source );
									endif;
								endif;
							endforeach;
						
						endif;
					}
						header('Content-type: application/javascript');
							require_once( 'ext/jspacker.php' );
							$packer = new JavaScriptPacker($buffer, 'Normal', true, false);
						exit( $packer->pack() );
				break;
			default:
				$communicator->error("Resource Not Specified");
				break;
		}
	};