<?php


namespace calderawp\interop;

use calderawp\interop\Contracts\Interoperable;
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
     * @var string
     */
    private $type;

    /**
     * Set the type of entity being collected
     *
     * @param string $type The type identifier
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /** @inheritdoc */
    public function getType()
    {
        return $this->type;
    }

    /** @inheritdoc */
    public function addEntity(InteroperableEntity $entity)
    {
        $this->set($entity->getId(), $entity);
        return $this;
    }


    /** @inheritdoc */
    public function reset(array $items)
    {
        $this->clear();
        foreach ($items as $item) {
            $this->set(
                $this->findId($item),
                $item
            );
        }
        return $this;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $items = [];
        foreach ($this->getValues() as $item) {
            $id = $this->findId($item);
            if( ! is_null($id)){
                $items[$id] = $item;
            }else{
                $items[] = $item;
            }
        }

        return $items;
    }

    /**
     * Find the ID of a data if possible
     *
     * @param Interoperable|array $arrayOrInteoperable
     * @return null
     */
    protected function findId($arrayOrInteoperable)
    {
        $id = null;
        if (is_a($arrayOrInteoperable, Interoperable::class)) {
            $id = $arrayOrInteoperable->getId();
        } elseif (array_key_exists('ID', $arrayOrInteoperable)) {
            $id = $arrayOrInteoperable['ID'];
        } elseif (array_key_exists('id', $arrayOrInteoperable)) {
            $id = $arrayOrInteoperable['id'];
        }
        return $id;
        
    }
}
