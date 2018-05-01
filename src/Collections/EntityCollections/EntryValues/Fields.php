<?php


namespace calderawp\interop\Collections\EntityCollections\EntryValues;

use calderawp\interop\Collections\EntityCollections\EntityCollection;
use calderawp\interop\Entities\Entry\Field;

/**
 * Class Fields
 *
 * Object representation of a collection of field values of an entry
 *
 * @package calderawp\interop\Collections\EntityCollections\EntryValues
 */
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

	/** @inheritdoc */
	public function getEntityType()
	{
		return Field::class;
	}

	public function hasField($id)
	{
		return $this->has($id);
	}
}
