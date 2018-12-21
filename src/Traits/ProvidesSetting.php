<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\HasSetting;
use calderawp\interop\Contracts\CalderaContract;

trait ProvidesSetting
{

	/**
	 * @var HasSetting
	 */
	private $setting;

	/**
	 * Get the setting
	 *
	 * @return HasSetting
	 */
	public function getSetting(): HasSetting
	{
		return $this->setting;
	}

	/**
	 * Set the setting
	 *
	 * @param HasSetting $setting
	 *
	 * @return CalderaContract
	 */
	public function setSetting(HasSetting $setting): CalderaContract
	{
		$this->setting = $setting;
		return $this;
	}
}
