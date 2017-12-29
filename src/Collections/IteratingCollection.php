<?php


namespace calderawp\interop\Collections;


use calderawp\interop\Entities\Entity;
use calderawp\interop\Exceptions\Exception;
use calderawp\interop\Interfaces\CreateFromStdClass;
use calderawp\interop\Traits\CanCastObjectToArray;

abstract class IteratingCollection extends Collection implements \Iterator, CreateFromStdClass
{

    use CanCastObjectToArray;
    /**
     * @var array
     */
    protected $items;

    /**
     * @var int
     */
    protected $position;

    private $positionMap;

    /**
     * Get name of setter function for adding items to collection
     *
     * @return string
     */
    abstract public function getEntitySetter();



    /**
     * Get class reference for entity being collected
     *
     * @return string
     */
    abstract public function getEntityType();

    /**
     * Get number of items in collection
     *
     * @return integer
     */
    final public function count()
    {
        return count($this->items);
    }

    /**
     * IteratingCollection constructor.
     * @param Entity[] $items Optional. Array of compatible entities
     */
    public function __construct( array  $items = []) {
        $this->position = 0;
        if( ! empty( $items)){
            $this->setEntitiesFromArray($items,$this);
        }


    }

    /**
     * @param $id
     * @return int
     */
    protected function mapPosition($id)
    {
        $this->positionMap[] = $id;
        return count($this->positionMap) -1;
    }

    /**
     * Create collection from array
     *
     * @param Entity[] $data Array of compatible entities
     * @return static
     */
    public static function fromArray(array $data)
    {
        $obj = new static;
        $obj->setEntitiesFromArray($data, $obj);
        return $obj;
    }

    /** @inheritdoc */
    public static function fromStdClass($data)
    {
        $obj = new static();
        if (! empty($data)) {
            foreach ($data as $datum) {
                $entity = call_user_func([ $obj->getEntityType(), 'fromStdClass'], $datum);
                call_user_func([$obj,$obj->getEntitySetter()], $entity);
            }
        }

        return $obj;
    }

    /**
     * Set an array of entities on the object
     *
     * @param Entity[] $data Array of compatible entities
     * @param static|null $obj Object to set on. If null $this is used.
     *
     * @throws Exception
     */
    public  function setEntitiesFromArray(array $data, $obj = null )
    {
        if( ! $obj ){
            $obj = $this;
        }
        foreach ($data as $entity) {
            if ( ! $this->isCorrectEntity($entity)) {
                $entity = $this->maybeCastObject($entity);
                if( is_array($entity)){
                    $entity = call_user_func([ $this->getEntityType(), 'fromArray'],$entity);
                }
            }

            if ( $this->isCorrectEntity($entity)) {
                call_user_func([$obj, $obj->getEntitySetter()], $entity);
            }else{
                throw new Exception( sprintf( 'Not valid type to set as entity. Type is: %s. Type should be %s', getType($entity),$this->getEntityType()));
            }
        }
    }

    /**
     * Is object (or whatever) the correct entity type
     *
     * @param Entity|array|\stdClass $maybeEntity
     * @return bool
     */
    public function isCorrectEntity( $maybeEntity )
    {
        return is_object( $maybeEntity ) && is_a( $maybeEntity, $this->getEntityType() );
    }

    /** @inheritdoc */
    public function rewind() {
        $this->position = 0;
    }

    /** @inheritdoc */
    public function current() {
        return $this->items[$this->positionMap[$this->position]];
    }

    /** @inheritdoc */
    public function key() {
        return $this->position;
    }

    /** @inheritdoc */
    public function next() {
        ++$this->position;
    }

    /** @inheritdoc */
    public function valid() {
        return isset($this->positionMap[$this->position],$this->items[$this->positionMap[$this->position]]);
    }

}