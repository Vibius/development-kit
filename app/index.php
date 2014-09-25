<?php

/*	
	App setup
*/

$errorOutput = function($message, $line, $file){
	/*echo "
		<h2>Something went wrong: </h2>
		<p> $message </p>
		<p> On line: <b>$line</b>, in file: <b>$file</b> </p>
	";*/
	Shield::deffend($message, $line, $file, 'now empty', 'now empty');
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

//Run the framework!
$framework->bootstrap();


//If you want to delete alias cache on every run, set deleteAliases in config.php to true

//Add an alias to the app, which enables you to run container operations within "aliases" alias as shown below
Container::open('aliases')->add('alias', Container::open('aliases'));

//now we can use Storage:: alias to operate specific container instance
Alias::add('storage', Container::open('storage'));


/*
	Your code goes down here 
*/


require 'app.php';



/*
	Execution time displays from here
*/
