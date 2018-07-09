<?php


namespace calderawp\interop\CalderaForms\Form;


use calderawp\interop\Model;

class FormModel extends Model
{

    /** @inheritdoc */
    public static function fromArray(array $data)
    {
        $entity = Entity::fromArray($data);
        return static::fromEntity($entity);
    }
}