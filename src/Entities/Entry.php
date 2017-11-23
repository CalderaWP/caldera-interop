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
    protected  $form;


    public function __construct( Details $entryDetails, Fields $fields, Form $form )
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
    public function getFieldValue( $id )
    {
        if( $this->getFieldValues()->hasField( $id ) ){
            return $this->fieldValues->getField( $id );
        }

        return null;
    }

}