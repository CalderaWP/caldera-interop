<?php

namespace calderawp\interop\Mock;

/**
 * Class Entity
 *
 * Entity object for testing arbitrary Entity registration/ retrieval.
 *
 *
 * @package calderawp\interop\Mock
 */
class Entity extends \calderawp\interop\Entities\Entity
{

    protected $foo;

    public static function getType()
    {
        return 'mock';
    }

    public function isValid()
    {
        return true;
    }


}