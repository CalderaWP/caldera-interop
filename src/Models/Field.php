<?php


namespace calderawp\interop\Models;

use \calderawp\interop\Entities\Form as FormEntity;
use \calderawp\interop\Entities\Field as FieldEntity;
use GuzzleHttp\Psr7\Response;

class Field extends Model
{

    public function getEntityType()
    {
        return FieldEntity::class;
    }


    /** @inheritdoc */
    public static function getType()
    {
        return 'field';
    }
}