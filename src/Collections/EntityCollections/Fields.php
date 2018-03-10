<?php

namespace calderawp\interop\Collections\EntityCollections;

use calderawp\interop\Entities\Field;

class Fields extends EntityCollection
{

	/** @var array */
	protected $fields;

	/**
	 * Fields constructor.
	 * @param array $fields Array of Field entity object
	 */
	public function __construct(array  $fields = [])
	{
		if (! empty($fields)) {
			foreach ($fields as $field) {
				if (is_array($field)) {
					$field = new Field($field);
				}
				$this->addField($field);
			}
		}
	}

	/**
	 * Add a field to collection
	 *
	 * @param Field $field
	 * @return $this
	 */
	public function addField(Field $field)
	{
		$this->fields[ $field->getId() ] = $field;
		return $this;
	}

	/**
	 * Get a field by ID
	 *
	 * @param int $id
	 * @return Field|null
	 */
	public function getField($id)
	{
		return isset($this->fields[ $id ]) ? $this->fields[ $id ] : null;
	}

	/** @inheritdoc */
	public function toArray()
	{
		 $fields = [];

		 /** @var Field $field */
		foreach ($this->fields as $field) {
			$fields[ $field->getId() ] = $field->toArray();
		}
		 return $fields;
	}
}
