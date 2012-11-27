<?php

namespace NetteCli;

use Doctrine\DBAL\Migrations\Configuration\Configuration;

class DoctrineMigrationsCommandSet extends \Nette\Object implements \NetteCli\CommandSet
{
	/** @var \Doctrine\DBAL\Migrations\Configuration\Configuration */
	private $configuration;

	public function __construct(Configuration $configuration)
	{
		$this->configuration = $configuration;
	}

	public function addCommands(\Symfony\Component\Console\Application $cli)
	{
		foreach ($this->getCommands() as $command) {
			$command->setMigrationConfiguration($this->configuration);
			$cli->add($command);
		}
	}

	private function getCommands()
	{
		return array(
			new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
			new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
			new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
			new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
			new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
			new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand(),
		);
	}
}
