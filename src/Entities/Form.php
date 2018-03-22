<?php

namespace calderawp\interop\Entities;

use calderawp\interop\Collections\EntityCollections\Fields as FieldsCollection;
use calderawp\interop\Collections\EntityCollections\Fields;
use Psr\Http\Message\RequestInterface as Request;

class Form extends Entity
{

	/**
	 * @var FieldsCollection
	 */
	protected $fields;

	protected $processors;

	protected $settings;

	protected $conditionals;

	/**
	 * @var string
	 */
	protected $name;

	public function __construct(array $formArray = [])
	{
		$formArray = $this->setName($formArray);
		$this->setFields($formArray);
	}

    /** @inheritdoc */
	public static function fromArray(array $items)
    {
        /** @var Form $obj */
        $obj = parent::fromArray($items);
        if( isset( $items['fields'] ) && is_array( $items['fields' ] ) ){
            $obj->fields = $obj->collectFields($items);
        }
        return $obj;
    }

    /**
	 * Add field to collection of fields
	 *
	 * @param  Field $field
	 * @return $this
	 */
	public function addField(Field $field)
	{
		$this->fields->addField($field);
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function toArray()
	{
		return array_merge(parent::toArray(), [
			'fields' => $this->getFields()->toArray(),
		]);
	}

	/**
	 * Get field by ID from collection of fields
	 *
	 * @param  string $id
	 * @return Field|null
	 */
	public function getFieldById($id)
	{
		return $this->fields->getField($id);
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get fields collection
	 *
	 * @return Fields
	 */
	public function getFields()
	{
	    if( is_array( $this->fields ) ){
	        $this->fields = $this->collectFields( [ 'fields' => $this->fields ] );
        }
		return $this->fields;
	}

	/**
	 * Set fields property
	 *
	 * @param array $formArray
	 */
	private function setFields(array $formArray)
	{
		$this->fields = $this->collectFields($formArray);
	}

    /**
     * Create fields collection from form config array
     *
     * @param array $formArray
     *
     * @return Fields
     */
	public function collectFields(array $formArray){
        $fields = isset($formArray['fields']) && is_array($formArray['fields'])
            ? $formArray['fields']
            : [];
        return new Fields($fields);
    }

	/**
	 * Set name property
	 *
	 * @param  array $formArray
	 * @return array
	 */
	private function setName(array $formArray)
	{
		$this->name = isset($formArray['name'])
		? $formArray['name']
		: '';
		return $formArray;
	}

}
