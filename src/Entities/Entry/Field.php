<?php


namespace calderawp\interop\Entities\Entry;

use calderawp\interop\Entities\Entity;

/**
 * Class Field
 *
 * Object representation of an entry field. In Caldera Forms stored as a row in $prefix_cf_form_entry_values
 *
 * @package calderawp\interop\Entities\Entry
 */
class Field extends Entity
{

	/**
	 * @var  int
	 */
	protected $entry_id;

	/**
	 * @var  string
	 */
	protected $field_id;

	/**
	 * @var  string
	 */
	protected $slug;

	/**
	 * @var  string|array
	 */
	protected $value;


	/**
	 * Field constructor.
	 *
	 * @param array $values
	 */
	public function __construct(array $values = [])
	{
		if (! empty($values[ 'id' ])) {
			$this->setId($values['id']);
		}

		if (! empty($values[ 'ID' ])) {
			$this->setId($values['ID']);
		}

		if (! empty($values)) {
			foreach ($values as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}
	}


	/**
	 * Get field slug
	 *
	 * @return string
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * Get field value
	 *
	 * @return array|string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/** @inheritdoc */
	public static function getType()
	{
		return 'entry.field';
	}
}
