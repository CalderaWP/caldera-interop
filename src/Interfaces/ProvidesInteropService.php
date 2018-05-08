<?php


namespace calderawp\interop\Interfaces;

/**
 * Interface ProvidesInteropService
 *
 * Service that all interoperable sets MUST use to bind to the interoperable service container.
 *
 */
interface ProvidesInteropService extends ProvidesAliasesService
{
	/**
	 * Callback to bind interoperable set to the interoperable service container
	 *
	 * @param CalderaFormsApp $calderaFormsApp
	 * @return $this
	 */
	public function bindInterop(CalderaFormsApp $calderaFormsApp);
}