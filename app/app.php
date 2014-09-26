<?php

/*Router::add('/',function(){
	echo "Welcome to Vibius 3 development kit";
});*/

// add a new route, which uses later defined regex alternatives,
Router::add('/(profile)/<:num>', function(){
	// return class, function
	return ['App\\controllers\\WelcomeController','index'];
})->alias([
	// create an alias for the parent route, which will hold the same functions as parent,
	// but will respond to different url/type
	'/(profile)/<:doge>'  => 'GET',
	'/' => 'GET'
]);

// add some regex alternatives for routes
Router::alternatives()->add('<:num>', '(\\d+)');

Router::alternatives()->add('<:doge>', '(woof)');

// find the route match
$match = Router::dispatch();

if($match){
	//execute the route match here
	$responseHandlers = $match['callback']();
	call_user_func_array($responseHandlers, Request::segmentArray());

}else{
	//handle 404 here
	echo 'not found!';
}

echo "<p> <b>Execution time: </b>".(round((microtime(true) - $GLOBALS['execution_time']) * 1000, 2))." ms, <b>Memmory used: </b>".(memory_get_peak_usage(true) / 1024 / 1024)." MB</p>";

















