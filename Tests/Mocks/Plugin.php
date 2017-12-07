<?php


namespace calderawp\interop\Mock;


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
}