<?php


namespace calderawp\interop\Interfaces;


use calderawp\interop\ServiceControlledContainer;
use Psr\Container\ContainerInterface;

/**
 * Interface PluginOrApp
 *
 * Interface that any implementation acting as a Plugin or App MUST implement
 *
 * @package calderawp\interop\Interfaces
 */
interface PluginOrApp extends ContainerInterface {

    /**
     * Get the version number of the app or plugin.
     *
     * @return string
     */
    public function version();

    /**
     * Get the base path of app or plugin.
     *
     * @return string
     */
    public function basePath();


}