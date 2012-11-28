<?php

namespace App\Model\Domain;

class User extends \Nette\Object
{
	protected $login;

	protected $passwordHash;

	public function getPasswordHash()
	{
		return $this->passwordHash;
	}

	public function setPassword($password, $salt)
	{
		$this->passwordHash = crypt($password, $salt);
	}
}
