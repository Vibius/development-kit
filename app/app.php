<?php


Storage::add('test','ayer');

Storage::add('lel','do');

#print_r(Request::get('username'));


Router::add('/',function(){
	echo "/profile!";
});

Router::add('/test',function(){
	echo "/test!";
});

$match = Router::dispatch();


$match['callback']();


echo "<p> <b>Execution time: </b>".(round((microtime(true) - $GLOBALS['execution_time']) * 1000, 2))." ms, <b>Memmory used: </b>".(memory_get_peak_usage(true) / 1024 / 1024)." MB</p>";

















