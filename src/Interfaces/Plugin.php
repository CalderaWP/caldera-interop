<?php


namespace calderawp\interop\Interfaces;

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



}