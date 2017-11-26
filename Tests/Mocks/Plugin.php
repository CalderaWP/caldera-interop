<?php


namespace calderawp\interop\Mock;


class Plugin implements \calderawp\interop\Interfaces\Plugin
{

    public function get( $id )
    {
        return false;
    }

    public function has( $id ){
        return false;
    }

    public function version()
    {
        return '1.9.0';
    }

    public function getOverrideMap()
    {
        return [
            'Entities.Entry.Details' => \calderawp\interop\Mock\Entity::class
        ];
    }

    public function getNamespace()
    {
        return "calderawp\\interop\Mock\\";
    }

    public function basePath()
    {
        return dirname( __FILE__ );
    }
}