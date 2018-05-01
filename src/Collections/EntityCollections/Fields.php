<?php

namespace calderawp\interop\Collections\EntityCollections;

use calderawp\interop\Collections\IteratingCollection;
use calderawp\interop\Entities\Field;
use calderawp\interop\Interfaces\CollectsEntities;

class Fields extends IteratingCollection implements CollectsEntities
{


	/**
	 * @inheritdoc
	 */
	public function getEntitySetter()
	{
		return 'addField';
	}

	/**
	 * @inheritdoc
	 */
	public function getEntityType()
	{
		return Field::class;
	}

	/** @inheritdoc */
	public function addField(Field $field)
	{
		return $this->addEntity($field);
	}

	/** @inheritdoc */
	public function getField($id)
	{
		return $this->getEntity($id);
	}

}
