<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Collections\Attributes;

interface HasAttributes
{
	/**
	 * Get attributes collection
	 *
	 * @return Attributes
	 */
	public function getAttributes(): Attributes;

	/**
	 * (re)Set attributes collection
	 *
	 * @param Attributes $attributesCollection
	 *
	 * @return HasAttributes
	 */
	public function setAttributesCollection(Attributes $attributesCollection): HasAttributes;
}
