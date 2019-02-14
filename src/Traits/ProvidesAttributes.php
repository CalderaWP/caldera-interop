<?php


namespace calderawp\interop\Traits;


use calderawp\interop\Collections\Attributes;

trait ProvidesAttributes
{
	/**
	 * @var Attributes
	 */
	protected $attributesCollection;

	/**
	 * Get attributes collection
	 *
	 * @return Attributes
	 */
	public function getAttributes() : Attributes
	{
		return ! is_null($this->attributesCollection) ? $this->attributesCollection : new Attributes();

	}

	/**
	 * (re)Set attributes collection
	 *
	 * @param Attributes $attributesCollection
	 *
	 * @return ProvidesAttributes
	 */
	public function setAttributesCollection(Attributes $attributesCollection): ProvidesAttributes
	{
		$this->attributesCollection = $attributesCollection;
		return $this;
	}


}
