<?php


namespace calderawp\interop\Interfaces;

use calderawp\interop\Service\Container;

/**
 * Interface ProvidesService
 *
 * Interface that all service providers MUST implement
 *
 * @package calderawp\interop\Interfaces
 */
interface ProvidesService
{
    /**
     * Register provider
     *
     * @param Container $container
     */
	public function registerService(Container $container);
}
