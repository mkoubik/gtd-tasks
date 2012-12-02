<?php

namespace Test;

class AuthenticatorTest extends TestCase
{
	public function testAuthenticateOK()
	{
		$usersRepository = $this->mockUsersRepository_OK();
		$authenticator = new \App\Model\Services\Authenticator($usersRepository, 'salt');
		$identity = $authenticator->authenticate(array('john', 'password'));

		$this->assertInstanceOf('Nette\Security\\Identity', $identity);
		$this->assertEquals(123, $identity->getId());
		$this->assertEquals(array('user'), $identity->getRoles());
		$this->assertEquals(array(), $identity->getData());
	}

	public function testAuthenticateBadPassword()
	{
		$usersRepository = $this->mockUsersRepository_BadPassword();
		$authenticator = new \App\Model\Services\Authenticator($usersRepository, 'salt');
		try {
			$identity = $authenticator->authenticate(array('john', 'wrong password'));
		} catch(\Nette\Security\AuthenticationException $e) {
			$this->assertEquals(\Nette\Security\IAuthenticator::INVALID_CREDENTIAL, $e->getCode());
			return;
		}
		$this->fail('Expected \\Nette\\Security\\AuthenticatiobException');
	}

	public function testAuthenticateBadLogin()
	{
		$usersRepository = $this->mockUsersRepository_BadLogin();
		$authenticator = new \App\Model\Services\Authenticator($usersRepository, 'salt');
		try {
			$identity = $authenticator->authenticate(array('non-existing-user', 'password'));
		} catch(\Nette\Security\AuthenticationException $e) {
			$this->assertEquals(\Nette\Security\IAuthenticator::IDENTITY_NOT_FOUND, $e->getCode());
			return;
		}
		$this->fail('Expected \\Nette\\Security\\AuthenticatiobException');
	}

	private function mockUsersRepository_OK()
	{
		$user = $this->mockista->create('App\\Model\\Domain\\User', array(
			'getId' => 123,
			'getLogin' => 'john',
		));
		$user->expects('verifyPassword')->once()->with('password', 'salt')->andReturn(TRUE);

		$builder = $this->mockista->createBuilder('App\\Model\\Repositories\\Users');
		$builder->findOneBy(array('login' => 'john'))->once()->andReturn($user);
		return $builder->getMock();
	}

	private function mockUsersRepository_BadPassword()
	{
		$user = $this->mockista->create('App\\Model\\Domain\\User', array(
			'getId' => 123,
			'getLogin' => 'john',
		));
		$user->expects('verifyPassword')->once()->with('wrong password', 'salt')->andReturn(FALSE);

		$builder = $this->mockista->createBuilder('App\\Model\\Repositories\\Users');
		$builder->findOneBy(array('login' => 'john'))->once()->andReturn($user);
		return $builder->getMock();
	}

	private function mockUsersRepository_BadLogin()
	{
		$builder = $this->mockista->createBuilder('App\\Model\\Repositories\\Users');
		$builder->findOneBy(array('login' => 'non-existing-user'))->once()->andReturn(NULL);
		return $builder->getMock();
	}
}
