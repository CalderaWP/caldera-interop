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
	public function getEntityType()
	{
		return Field::getType();
	}

	/**
	 * @var array
	 */
	private $fields;

	/**
	 * Fields constructor.
	 *
	 * @param array $fields Array of calderawp\interop\Entities\Entry\Field objects
	 */
	public function __construct(array  $fields = [])
	{
		if (! empty($fields)) {
			foreach ($fields as $field) {
				$this->addField($field);
			}
		}
	}

	/**
	 * Add field to collection
	 *
	 * @param  Field $field
	 * @return $this
	 */
	public function addField(Field $field)
	{
		$this->fields[ $field->getId() ] = $field;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function toArray()
	{
		$fields = [];
		/**
 * @var Field $field
*/
		foreach ($this->fields as $field) {
			$fields[$field->getId()] = $field->toArray();
		}

		return $fields;
	}

	/**
	 * Get a field entity from collection
	 *
	 * @param  string|int $id Field ID
	 * @return Field|null Field
	 */
	public function getField($id)
	{
		if ($this->hasField($id)) {
			return $this->fields[ $id ];
		}
		return null;
	}

	/**
	 * Check if field is present in collection
	 *
	 * @param  string|int $id Field ID
	 * @return bool
	 */
	public function hasField($id)
	{
		return ! empty($this->fields[ $id ]);
	}
}
