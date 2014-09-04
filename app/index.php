<?php

/*	
	App setup
*/

$errorOutput = function($message, $line, $file){
	echo "
		<h2>Something went wrong: </h2>
		<p> $message </p>
		<p> On line: <b>$line</b>, in file: <b>$file</b> </p>
	";
};



$errorHandler = function($errno, $errstr, $errfile, $errline) use ($errorOutput){
	ob_clean();
	$errorOutput($errstr, $errline, $errfile);
	die();
};

$shutdownHandler = function() use ($errorOutput){
	$error = error_get_last();
	if( !empty($error) ){	
		ob_clean();
		$errstr = $error['message'];
		$errline = $error['line'];
		$errfile = $error['file'];
		$errorOutput($errstr, $errline, $errfile);	
	}
};

$exceptionHandler = function($e) use ($errorOutput){
	ob_clean();
	$message = $e->getMessage();
	$line = $e->getLine();
	$file = $e->getFile();

	$errorOutput($message, $line, $file);
	die();
};

set_error_handler($errorHandler);
set_exception_handler($exceptionHandler);
register_shutdown_function($shutdownHandler);

// add config from app/config.php
Config::addConfig('config');

//deletes all cached aliases
//comment out the next line to improve the performance but keep the cached aliases
#$framework->_deleteAliases();

//Add an alias to the app, which enables you to run container operations within "aliases" alias as shown below
Container::open('aliases')->add('aliases', Container::open('aliases'));

//now we can use Storage:: alias to operate specific container instance
Aliases::add('storage', Container::open('storage'));

/*
	Your code goes down here 
*/


require 'app.php';



/*
	Execution time displays from here
*/
echo "<p> <b>Execution time: </b>".(round((microtime(true) - $GLOBALS['execution_time']) * 1000, 2))." ms, <b>Memmory used: </b>".(memory_get_peak_usage(true) / 1024 / 1024)." MB</p>";