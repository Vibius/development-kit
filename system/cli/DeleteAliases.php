<?php

require 'init.php';

$psr4 = require BASEPATH.'/vendor/composer/autoload_psr4.php';

$aliasManager = new Vibius\Facade\AliasManager();

$aliasManager->deleteAllAliases();