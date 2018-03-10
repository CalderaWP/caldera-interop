<?php


namespace calderawp\interop\ArrayLike;

use calderawp\interop\Traits\HasId;

/**
 * Class Form
 *
 * Array-like object representing a form
 *
 * @package calderawp\interop\ArrayLike
 */
class Form extends ArrayLike
{

    use HasId;

    /**
     * @inheritdoc 
     */
    public function getId()
    {
        return $this->offsetGet('ID');
    }

    /**
     * @inheritdoc 
     */
    public function setId($id)
    {
        $this->offsetSet('ID', $id);
        return $this;
    }


}