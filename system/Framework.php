<?php

class Framework{

	function __construct(){

		$this->app = dirname(__dir__).'/app/';

		
	}

	public function bootstrap(){

		session_start();

		error_reporting(E_ALL); ini_set('display_errors', '1');

		require '../vendor/autoload.php';

		define('vibius_BASEPATH', dirname(__DIR__).'/');

		$this->aliasManager = new Vibius\Facade\AliasManager();
		$this->aliasManager->registerAutoloader();

		// add config from app/config.php
		Config::addConfig('config');

		$this->aliasManager->registerAliasDeleter();

	}

	public function _deleteAliases(){
		$this->aliasManager->deleteAllAliases();
	}

	public function start(){

		$this->bootstrap();

			$framework = $this;
			require $this->app.'index.php';
	}

}

$framework = new Framework();
return $framework;
