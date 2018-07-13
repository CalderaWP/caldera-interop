<?php
namespace calderawp\interop\Contracts;

/**
 * Interface CalderaFormsUiComponent
 *
 * Contact that components that load the UI client for `CalderaFormsInteroperableComponent`s MUST implement
 */
interface CalderaFormsUiComponent extends CalderaInteroperableComponent
{
	/**
	 * Get the root URI for the assets for this UI component
	 *
	 * If using in WordPress:
	 *  plugin_dir_path( __FILE__ )
	 *
	 * @return string
	 */
	public function getAssetsBaseUri();

	/**
	 * Signal to the application that these assets should be loaded
	 *
	 * In WordPress, call wp_enqueue_script here.
	 */
	public function enqueueAssets();

	/**
	 * Load any admin menus for this UI component
	 */
	public function addMenus();
}
