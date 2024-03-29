<?php

use Symfony\Component\Console\Application;
use Nette\Framework;

$container = require __DIR__ . '/app/bootstrap.php';
$helperSet = new Symfony\Component\Console\Helper\HelperSet();
foreach ($container->findByTag('Symfony\Component\Console\Helper\HelperInterface') as $service => $name) {
	$helperSet->set($container->getService($service), $name);
}

$cli = new Application(Framework::NAME . ' Command Line Interface', Framework::VERSION);
$cli->setCatchExceptions(TRUE);
$cli->setHelperSet($helperSet);

foreach ($container->findByTag('NetteCli\CommandSet') as $service => $meta) {
	$commandSet = $container->getService($service);
	$commandSet->addCommands($cli);
}

$cli->run();
