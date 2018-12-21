<?php


namespace calderawp\interop\Contracts;

interface HasLabel
{
	/**
	 * Get the label
	 *
	 * @return string
	 */
	public function getLabel(): string;

	/**
	 * Set the label
	 *
	 * @param string $label
	 *
	 * @return HasLabel
	 */
	public function setLabel(string $label): HasLabel;
}
