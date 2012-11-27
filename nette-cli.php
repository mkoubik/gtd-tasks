<?php

use Symfony\Component\Console\Application;
use Nette\Framework;

$container = require __DIR__ . '/app/bootstrap.php';
$helperSet = $container->getByType('Symfony\\Component\Console\\Helper\\HelperSet');

$cli = new Application(Framework::NAME . ' Command Line Interface', Framework::VERSION);
$cli->setCatchExceptions(TRUE);
$cli->setHelperSet($helperSet);
Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);
$cli->run();
