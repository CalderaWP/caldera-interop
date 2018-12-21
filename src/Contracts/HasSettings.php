<?php


namespace calderawp\interop\Contracts;
use calderawp\interop\Contracts\CalderaContract;

interface HasSettings
{

	/**
	 * @return HasSettings
	 */
	public function getSettings(): HasSettings;

	/**
	 * @param HasSettings $settings
	 *
	 * @return CalderaContract
	 */
	public function setSettings(HasSettings $settings): CalderaContract;
}
