<?php

namespace calderawp\interop\Collections\EntityCollections;

use calderawp\interop\Collections\IteratingCollection;
use calderawp\interop\Entities\Field;
use calderawp\interop\Interfaces\CollectsEntities;

class Fields extends EntityCollection
{


	/** @inheritdoc */
	public function getEntitySetter()
	{
		return 'addField';
	}

	/** @inheritdoc */
	public function getEntityGetter()
	{
		return 'getField';
	}

	/**
	 * @inheritdoc
	 */
	public function getEntityType()
	{
		return Field::class;
	}


	/** @inheritdoc */
	public function getField($id)
	{
		return $this->getEntity($id);
	}
}
