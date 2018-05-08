<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface ProvidesAliasesService
 *
 * Intreface that all service providers with aliases (for example those implimenting ProvidesService and ProvidesInteropService) MUST implement.
 *
 */
interface ProvidesAliasesService
{

	/**
	 * Get the container identifier for this service
	 *
	 * @return string
	 */
	public function getAlias();
}
