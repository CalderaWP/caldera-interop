<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\HasSettings;
use calderawp\interop\Contracts\CalderaContract;

trait ProvidesSettings
{

	/**
	 * @var HasSettings
	 */
	protected $settings;

	/**
	 * @return HasSettings
	 */
	public function getSettings(): HasSettings
	{
		return $this->settings;
	}

	/**
	 * @param HasSettings $settings
	 *
	 * @return CalderaContract
	 */
	public function setSettings(HasSettings $settings): CalderaContract
	{
		$this->settings = $settings;
		return $this;
	}
}
