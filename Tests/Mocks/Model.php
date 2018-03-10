<?php


namespace calderawp\interop\Mock;


class Model extends \calderawp\interop\Models\Model
{

    public function getEntityType()
    {
       return Entity::class;
    }

    public static function getType()
    {
        return 'mock';
    }

}