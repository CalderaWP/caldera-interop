<?php


namespace calderawp\interop\Entities;

use calderawp\interop\Collections\EntityCollections\EntryValues\Fields;
use calderawp\interop\Entities\Entry\Details;

class Entry extends Entity
{

	/** @var  Details */
	protected $entryDetails;

	/** @var  Fields */
	protected $fieldValues;

	/** @var Form */
	protected $form;


	/**
	 * Entry constructor.
	 * @param Details $entryDetails Entity describing basic details (time, user ID, form ID) of entry
	 * @param Fields $fields Collection of field values (a collection of calderawp\interop\Entities\Entry\Field objects)
	 * @param Form $form Form that created this entry
	 */
	public function __construct(Details $entryDetails, Fields $fields, Form $form)
	{
		$this->entryDetails = $entryDetails;
		$this->fieldValues = $fields;
		$this->form = $form;
	}

	/**
	 * Get entry details entity
	 *
	 * @return Details
	 */
	public function getEntryDetails()
	{
		return $this->entryDetails;
	}

	/**
	 * Get collection of field values
	 *
	 * @return Fields
	 */
	public function getFieldValues()
	{
		return $this->fieldValues;
	}

	/**
	 * Get a field value form collection
	 *
	 * @param string|int $id
	 * @return Field|null
	 */
	public function getFieldValue($id)
	{
		if ($this->getFieldValues()->hasField($id)) {
			return $this->fieldValues->getField($id);
		}

		return null;
	}
}
