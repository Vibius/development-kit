<?php

$GLOBALS['execution_time'] = microtime(true);
$framework = require '../system/Framework.php';

define('vibius_INDEXPATH', dirname(__FILE__));

$framework->start();

