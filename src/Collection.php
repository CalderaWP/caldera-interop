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
	public function reset(array $items ){
	    $this->clear();
	    $this->createFrom($items);
	    return $this;
    }

    /** @inheritdoc */
    public function toArray()
    {
        $items = [];
        foreach ( $this as $item ){
            if( is_a( $item, Interoperable::class ) ){
                $items[ $item->getId() ] = $item;
            }else{
                if( array_key_exists( 'ID', $item) ){
                    $items[$item['ID']] = $item;
                }elseif( array_key_exists( 'id', $item) ){
                    $items[$item['id']] = $item;
                }else{
                    $items[] = $item;
                }
            }
        }

        return $items;
    }
}
