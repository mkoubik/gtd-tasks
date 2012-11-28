<?php

namespace Test\Model\Domain;

use Nette,
	Tester,
	Tester\Assert;

$container = require __DIR__ . '/../../bootstrap.php';

require __DIR__ . '/../../../app/model/Domain/User.php';


class UserTest extends Tester\TestCase
{
	private $container;

	private $user;

	function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
	}


	function setUp()
	{
	}


	function testSetPassword()
	{
		$user = new \App\Model\Domain\User();
		$user->setPassword('password', 'salt');
		Assert::equal('sa3tHJ3/KuYvI', $user->getPasswordHash());
	}

}


id(new UserTest($container))->run();