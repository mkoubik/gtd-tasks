<?php

namespace NetteCli;

class DoctrineCommandSet extends \Nette\Object implements \NetteCli\CommandSet
{
	public function addCommands(\Symfony\Component\Console\Application $cli)
	{
		\Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);
	}
}
