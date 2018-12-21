<?php


namespace calderawp\interop\Contracts;

interface HasSlug
{
	/**
	 * Get the slug
	 *
	 * @return string
	 */
	public function getSlug(): string ;

	/**
	 * Set the setting
	 *
	 * @param string $slug
	 *
	 * @return HasSlug
	 */
	public function setSlug(string $slug): HasSlug;
}
