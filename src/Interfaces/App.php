<?php


namespace calderawp\interop\Interfaces;


use calderawp\interop\ServiceControlledContainer;

interface App extends PluginOrApp
{

    /**
     * Get ServiceContainer object for app
     *
     * @return ServiceControlledContainer
     */
    public function getServiceContainer();

}