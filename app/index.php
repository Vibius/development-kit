<?php

/*	
	App setup
*/

$errorOutput = function($message, $line, $file, $trace = []){


	/*echo "
		<h2>Something went wrong: </h2>
		<p> $message </p>
		<p> On line: <b>$line</b>, in file: <b>$file</b> </p>
	";*/
	Shield::deffend($message, $line, $file, 'now empty', 'now empty', $trace);
};



$errorHandler = function($errno, $errstr, $errfile, $errline) use ($errorOutput){
	ob_clean();
	$errorOutput($errstr, $errline, $errfile, debug_backtrace());
	die();
};

$shutdownHandler = function() use ($errorOutput){
	$error = error_get_last();
	if( !empty($error) ){	
		ob_clean();
		$errstr = $error['message'];
		$errline = $error['line'];
		$errfile = $error['file'];
		$errorOutput($errstr, $errline, $errfile, debug_backtrace());	
	}
};

$exceptionHandler = function($e) use ($errorOutput){
	ob_clean();
	$message = $e->getMessage();
	$line = $e->getLine();
	$file = $e->getFile();
	$errorOutput($message, $line, $file, $e->getTrace());
	die();
};



//Run the framework!
$framework->bootstrap();

set_error_handler($errorHandler);
set_exception_handler($exceptionHandler);
register_shutdown_function($shutdownHandler);

//If you want to delete alias cache on every run, set deleteAliases in config.php to true

//Add an alias to the app, which enables you to run container operations within "alias" alias as shown below
Container::open('aliases')->add('alias', Container::open('aliases'));

//now we can use Storage:: alias to operate specific container instance
Alias::add('storage', Container::open('storage'));


/*
	Your code goes down here 
*/


require 'app.php';


