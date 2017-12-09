<?php


namespace calderawp\interop\Events;

use NetRivet\WordPress\EventEmitter;

class Events
{

    /**
     * Holds emitter to plugins API or whatever
     *
     * @since 0.0.1
     *
     * @var EventEmitter
     */
    protected $eventEmitter;

    /**
     * Hooks constructor.
     *
     * @since 0.0.1
     *
     * @TODO change type hint to EventEmitterInterface
     *
     * @param EventEmitter $eventEmitter
     */
    public function __construct( EventEmitter $eventEmitter  )
    {
        $this->eventEmitter = $eventEmitter;
    }

    /**
     * Add an action
     *
     * @since 0.0.1
     *
     * @param Event $hook
     *
     * @return $this
     */
    public function addAction( Event $hook )
    {
        $this->eventEmitter->on(
            $hook->getName(),
            $hook->callback,
            $hook->args,
            $hook->priority
        );
        return $this;
    }

    /**
     * Add a filter
     *
     * @since 0.0.1
     *
     * @param Event $event Hook object for filter
     *
     * @return $this
     */
    public function addFilter( Event $event )
    {
        $this->eventEmitter->filter(
            $event->getName(),
            $event->callback,
            $event->args,
            $event->priority
        );
        return $this;
    }

    /**
     * Apply filters
     *
     * @since 0.0.1
     *
     * @param string|Event $eventName Filter event
     * @param mixed $value Value for callback
     * @param array $args Other args
     * @return $this|mixed
     */
    public function applyFilters(  $eventName, $value, array $args = []  )
    {
        $eventName = $this->eventToName($eventName);
        return $this->eventEmitter->applyFilters(
            $eventName,
            $value,
            $args
        );
    }

    /**
     * Do action
     *
     * @since 0.0.1
     *
     * @param string|Event $eventName Action name
     * @param array $args Other args
     * @return $this|mixed
     */
    public function doAction( $eventName, array $args )
    {
        $eventName = $this->eventToName($eventName);

        return $this->eventEmitter->emit(
            $eventName,
            $args
        );
    }

    /**
     * @param string $eventName Event name.
     * @param bool|string $callback Optional. Name of callback to check.
     * @return bool
     */
    public function hasFilter( $eventName, $callback = false )
    {
        return $this->eventEmitter->hasFilter( $eventName, $callback );
    }



    /**
     * @param $eventName
     * @return mixed
     */
    public function eventToName($eventName)
    {
        if (is_a($eventName, Event::class)) {
            $eventName = $eventName->getName();
        }
        return $eventName;
    }

}