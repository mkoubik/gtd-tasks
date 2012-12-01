<?php

namespace Test;

class UserTest extends TestCase
{
	function testSetPassword()
	{
		$user = new \App\Model\Domain\User();
		$user->setPassword('password', 'salt');
		$this->assertEquals('sa3tHJ3/KuYvI', $user->getPasswordHash());
	}
}
