<?php

/* BOOTSTRAP */


/*require '../vendor/autoload.php';


try{

	$aliasManager = new Vibius\Facade\AliasManager();

	$aliasManager->registerAutoloader();

	#$aliasManager->deleteAllAliases();

	
	Container::open('aliases')->add('aliases', Container::open('aliases'));

	Aliases::add('something',new Vibius\Container\Container);
	
	echo something::add('hello','damn it works!');

	Config::addConfig('config');
	Config::getParameter('debugger','config');

	


}catch(Exception $e){
    //handle errors & exceptions
    echo "<h1>Exception:</h1>";
    echo $e->getMessage();
    echo $e->getLine();
    echo $e->getFile();
}
*/
$GLOBALS['execution_time'] = microtime(true);
$framework = require '../system/Framework.php';

$framework->start();