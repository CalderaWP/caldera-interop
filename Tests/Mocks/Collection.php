<?php


namespace calderawp\interop\Mock;

/**
 * Class Collection
 *
 * Collection object for testing arbitrary Collection registration/ retrieval.
 *
 * @package calderawp\interop\Mock
 */
class Collection extends \calderawp\interop\Collections\Collection
{
	/** @inheritdoc */
	public function toArray()
	{
		return [];
	}
}
