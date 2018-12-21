<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Contracts\HasSlug;

trait ProvidesSlug
{

	/**
	 * @var string
	 */
	protected $slug;
	/**
	 * Get the slug
	 *
	 * @return string
	 */
	public function getSlug(): string
	{
		return ! empty($this->slug) ? $this->slug : '';
	}

	/**
	 * Set the setting
	 *
	 * @param string $slug
	 *
	 * @return HasSlug
	 */
	public function setSlug(string $slug): HasSlug
	{
		$this->slug = $slug;
		return $this;
	}
}
