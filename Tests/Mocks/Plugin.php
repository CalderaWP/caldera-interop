<?php


namespace calderawp\interop\Mock;


use calderawp\interop\App;
use calderawp\interop\Events\Events;

class Plugin implements \calderawp\interop\Interfaces\Plugin
{
    /** @inheritdoc */
    public function get( $id )
    {
        return false;
    }

    /** @inheritdoc */
    public function has( $id ){
        return false;
    }

    /** @inheritdoc */
    public function version()
    {
        return '1.9.0';
    }

    /** @inheritdoc */
    public function getOverrideMap()
    {
        return [
            'Entities.Entry.Details' => \calderawp\interop\Mock\Entity::class
        ];
    }

    /** @inheritdoc */
    public function getNamespace()
    {
        return "calderawp\\interop\Mock\\";
    }

    /** @inheritdoc */
    public function basePath()
    {
        return dirname( __FILE__ );
    }

    /** @inheritdoc */
    public function pluginLoaded( Events $events )
    {
        // TODO: Implement pluginLoaded() method.
    }

    public function setApp(App $app)
    {
        // TODO: Implement setApp() method.
    }
}