<?php

namespace Test;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
	/** @var \Mockista\Registry */
	protected $mockista;

	protected function setUp()
	{
		$this->mockista = new \Mockista\Registry();
	}

	protected function tearDown()
	{
		$this->mockista->assertExpectations();
	}

	/** @return \Nette\DI\container */
	protected function getContext()
	{
		return \Nette\Environment::getContext();
	}
}
