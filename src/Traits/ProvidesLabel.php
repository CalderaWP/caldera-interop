<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\HasLabel;

trait ProvidesLabel
{

	/**
	 * @var string
	 */
	protected $label;

	/**
	 * Get the label
	 *
	 * @return string
	 */
	public function getLabel(): string
	{
		return !empty($this->label) ? $this->label : '';
	}

	/**
	 * Set the label
	 *
	 * @param string $label
	 *
	 * @return HasLabel
	 */
	public function setLabel(string $label): HasLabel
	{
		$this->label = $label;
		return $this;
	}
}
