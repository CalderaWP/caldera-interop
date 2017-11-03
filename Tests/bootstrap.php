<?php
if ( file_exists( dirname( __FILE__, 2  ) . '/vendor/autoload.php' ) ) {

	function loader($class)
	{
		$file = $class . '.php';
		if (file_exists($file)) {
			require $file;
		}
	}

	spl_autoload_register('loader');

	include_once dirname(__FILE__, 2) . '/vendor/autoload.php';
}else{
	throw  new Exception( 'No autoloader' );
}