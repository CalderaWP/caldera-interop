<?php


namespace calderawp\interop\Collections\EntityCollections;

use calderawp\interop\Collections\Collection;

abstract class EntityCollection extends Collection
{
	/** @inheritdoc */
	public function jsonSerialize()
	{
		return $this->toArray();
	}
}
