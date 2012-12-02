<?php

namespace App\Model\Services;

use App\Model\Repositories;

class Authenticator extends \Nette\Object implements \Nette\Security\IAuthenticator
{
	/** @var App\Model\Repositories\Users */
	private $usersRepository;

	private $salt;

	public function __construct(Repositories\Users $users, $salt)
	{
		$this->usersRepository = $users;
		$this->salt = $salt;
	}

	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$user = $this->usersRepository->findOneBy(array('login' => $username));

		if ($user === NULL) {
			throw new \Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
		}

		if (!$user->verifyPassword($password, $this->salt)) {
			throw new \Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		}

		return new \Nette\Security\Identity($user->getId(), 'user', array());
	}
}
