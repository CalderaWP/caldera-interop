<?php


namespace calderawp\interop\Contracts;
use calderawp\interop\Contracts\CalderaContract;

interface HasSetting
{
	/**
	 * Get the setting
	 *
	 * @return HasSetting
	 */
	public function getSetting(): HasSetting;

	/**
	 * Set the setting
	 *
	 * @param HasSetting $setting
	 *
	 * @return CalderaContract
	 */
	public function setSetting(HasSetting $setting): CalderaContract;
}
