<?php

namespace calderawp\interop\Collections\EntityCollections;


use calderawp\interop\Collections\IteratingCollection;
use calderawp\interop\Entities\Field;

class Fields extends IteratingCollection
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

    /**
     * Add a field to collection
     *
     * @param  Field $field
     * @return $this
     */
    public function addField( Field $field )
    {
        $this->items[ $field->getId() ] = $field;
        $this->mapPosition($field->getId());
        return $this;
    }

    /**
     * Get a field by ID
     *
     * @param  int $id
     * @return Field|null
     */
    public function getField( $id )
    {
        return isset($this->items[ $id ]) ? $this->items[ $id ] : null;

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
        foreach ( $this->items as  $field ){
            $fields[ $field->getId() ] = $field->toArray();
        }
        return $fields;
    }
}