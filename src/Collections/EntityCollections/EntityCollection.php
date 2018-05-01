<?php


namespace calderawp\interop\Collections\EntityCollections;

use calderawp\interop\Collections\IteratingCollection;
use calderawp\interop\Interfaces\CollectsEntities;

abstract class EntityCollection extends IteratingCollection implements CollectsEntities
{
	/** @inheritdoc */
	public function jsonSerialize()
	{
		return $this->toArray();
	}



	/** @inheritdoc */
	public function __call($name, $arguments)
	{
		if ($this->getEntitySetter() === $name) {
			return $this->addEntity($arguments[0]);
		}

		if ($this->getEntityGetter() === $name) {
			return $this->getEntity($arguments[0]);
		}
	}

	/**
	 * @param string|int $id Check if entity is in collection
	 * @return bool
	 */
	public function has($id)
	{
		return ! is_null($this->getEntity($id));
	}
}
