<?php


namespace calderawp\interop\Contracts;

interface HasDescription
{
	/**
	 * Get the description
	 *
	 * @return string
	 */
	public function getDescription(): string;

	/**
	 * Set the description
	 *
	 * @param string $description
	 *
	 * @return HasDescription
	 */
	public function setDescription(string $description): HasDescription;
}
