<?php


namespace calderawp\interop;

use calderawp\interop\Contracts\InteroperableCollection;
use calderawp\interop\Contracts\InteroperableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Collection
 *
 * A generic collection that can be used in most cases
 */
class Collection extends ArrayCollection implements InteroperableCollection
{

    /**
     * Add an entity to the collection
     *
     * @param InteroperableEntity $entity Entity to add
     * @return $this
     */
    public function addEntity(InteroperableEntity $entity )
    {
        $this->set( $entity->getId(), $entity );
        return $this;
    }

}
