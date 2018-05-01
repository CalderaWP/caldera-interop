<?php


namespace calderawp\interop\Collections\EntityCollections;

use calderawp\interop\Collections\IteratingCollection;
use calderawp\interop\Interfaces\CollectsEntities;

abstract class EntityCollection extends IteratingCollection implements CollectsEntities
{
	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}
}
