<?php

namespace App\Model\Domain;

/**
 * @Entity(repositoryClass="App\Model\Repositories\Users")
 */
class User extends \Nette\Object
{
	use Behaviors\Entity;

	/** @Column(type="string") */
	protected $login;

	/** @Column(type="string") */
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
