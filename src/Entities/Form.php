<?php

namespace calderawp\interop\Entities;

use calderawp\interop\Collections\EntityCollections\Fields as FieldsCollection;
use calderawp\interop\Collections\EntityCollections\Fields;

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

    public function __construct( array $formArray = [] )
    {
        $formArray = $this->setName($formArray);
        $this->setFields($formArray);

    }

    /**
     * Add field to collection of fields
     *
     * @param  Field $field
     * @return $this
     */
    public function addField( Field $field )
    {
        $this->fields->addField($field);
        return $this;
    }

    /**
     * @inheritdoc 
     */
    public function toArray()
    {
        return [
        'fields' => $this->getFields(),
        ];
    }

    /**
     * Get field by ID from collection of fields
     *
     * @param  string $id
     * @return Field|null
     */
    public function getFieldById( $id )
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
        return $this->fields;
    }

    /**
     * Set fields property
     *
     * @param array $formArray
     */
    private function setFields(array $formArray)
    {
        $_fields = isset($formArray['fields']) && is_array($formArray['fields'])
        ? $formArray['fields']
        : array();

        $this->fields = new Fields($_fields);
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