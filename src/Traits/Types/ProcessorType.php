<?php


namespace calderawp\interop\Traits\Types;

/**
 * Trait for Processor entity/model/collection to use to identify common type.
 *
 * Single source of string identifier for this entity/model/collection set.
 */
trait Processor
{
	/** @inheritdoc */
	public static function getType()
	{
		return 'cf.core.processor';
	}

	/** @inheritdoc */
	public function getTheType()
	{
		return 'cf.core.processor';
	}
}
