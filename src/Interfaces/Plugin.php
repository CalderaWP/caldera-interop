<?php


namespace calderawp\interop\Interfaces;
use calderawp\interop\Events\Events;
use calderawp\interop\App;

/**
 * Interface Plugin
 *
 * Interface any implementation acting as a plugin MUST implement
 *
 * @package calderawp\interop\Interfaces
 */
interface Plugin extends PluginOrApp
{

    /**
     * Get namespace to register in ServiceConta
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Get array of types to override with this namespace
     *
     * @return array
     */
    public function getOverrideMap();

    /**
     * Set app instance
     *
     * @param App $app
     *
     * @return $this
     */
    public function setApp( App $app );

    /**
     * Method of Plugin class called when plugin is loaded
     *
     * @param Events $events Events manager
     * @return void
     */
    public function pluginLoaded( Events $events );


}