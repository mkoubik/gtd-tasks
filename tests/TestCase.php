<?php

namespace Test;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
	/** @return \Nette\DI\container */
	protected function getContext()
	{
		return \Nette\Evironment::getContext();
	}
}
