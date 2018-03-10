<?php


namespace calderawp\interop\Models;

use \calderawp\interop\Entities\Form as FormEntity;
use \calderawp\interop\Entities\Field as FieldEntity;

use GuzzleHttp\Psr7\Response;

class Form extends Model
{

    /**
     * @inheritdoc 
     */
    public function getEntityType()
    {
        return FormEntity::class;
    }


    /**
     * @return FormEntity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return \calderawp\interop\Collections\EntityCollections\Fields
     */
    public function getFields()
    {
        return $this->entity->getFields();
    }

    /**
     * @inheritdoc 
     */
    public static function getType()
    {
        return 'form';
    }
}