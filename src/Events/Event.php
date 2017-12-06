<?php


namespace calderawp\interop\Events;



class Event
{

    /**
     * Name of hook
     *
     * @var string
     */
    protected $name;

    /**
     * Callback for hook
     *
     * @var string|array|callable
     */
    protected $callback;

    /**
     * Number of arguments for hook
     *
     * @var int
     */
    protected $args = 1;

    /**
     * Priority of hook
     *
     * @var int
     */
    protected $priority = 10;



    /** @inheritdoc */
    public function __get($name)
    {
        if( 'hook' === $name ){
            return $this->getName();
        }
        return $this->$name;
    }

    /**
     * Get event name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Event constructor.
     *
     * This constructor, using a stdClass, makes no sense.
     *
     * @param \stdClass $obj Pass stdClass object, props must match
     */
    public function __construct( \stdClass $obj )
    {
        foreach ( get_object_vars( $this ) as $prop => $var ){
            if( 'hook' === $prop  ){
                $this->name = $var;
            }elseif( property_exists( $obj, $prop ) ){
                $this->$prop = $obj->$prop;
            }
        }

    }

    /**
     * Create hook from array if it is an array and valid
     *
     * @param Event|array $event
     * @return Event
     */
    public static  function maybeFromArray($event)
    {
        if (is_array($event) && isset($event['hook']) && !isset($event['name'])) {
            $event['name'] = $event['hook'];
        }

        if (is_array($event) && isset($event['name'], $event['callback'])) {
            $event = self::fromArray($event);
        }

        return $event;
    }


    /**
     * Create hook from array
     *
     * @param array $event
     * @return Event
     */
    public static function fromArray($event)
    {
        $event = new Event((object)$event);
        return $event;
    }

}