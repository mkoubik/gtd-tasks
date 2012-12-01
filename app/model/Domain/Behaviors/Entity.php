<?php

namespace App\Model\Domain\Behaviors;

/**
 * @MappedSuperclass
 */
trait Entity
{
	/**
	 * @id
	 * @generatedValue
	 * @column(type="integer")
	 */
	protected $id;
}
