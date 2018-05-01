<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface ProvidesService
 *
 * Interface that all service providers MUST implement
 *
 * @package calderawp\interop\Interfaces
 */
interface ProvidesService extends \calderawp\CalderaContainers\Interfaces\ProvidesService
{

	/**
	 * Get the container identifier for this service
	 *
	 * @return string
	 */
	public function getAlias();
}
