<?php


namespace calderawp\interop\Interfaces;


use calderawp\interop\ServiceContainer;

interface App extends PluginOrApp
{

    /**
     * Get ServiceContainer object for app
     *
     * @return ServiceContainer
     */
    public function getServiceContainer();

}