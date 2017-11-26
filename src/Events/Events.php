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
    protected $eventsStysem;

    /**
     * Hooks constructor.
     *
     * @since 0.0.1
     *
     * @param EventEmitter $eventsStysem
     */
    public function __construct( EventEmitter $eventsStysem  )
    {
        $this->eventsStysem = $eventsStysem;
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
        $this->eventsStysem->on(
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
        $this->eventsStysem->filter(
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
    public function applyFilters(  $eventName, $value, array $args  )
    {
        $eventName = $this->eventToName($eventName);
        return $this->eventsStysem->applyFilters(
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

        return $this->eventsStysem->emit(
            $eventName,
            $args
        );
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