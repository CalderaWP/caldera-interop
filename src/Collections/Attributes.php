<?php


namespace calderawp\interop\Collections;


use calderawp\interop\Attribute;
use calderawp\interop\IteratableCollection;

class Attributes extends IteratableCollection
{
	/** @var Attribute[] */
	protected $attributes;

	/** @inheritdoc */
	protected function storeKey(): string
	{
		return 'attributes';
	}

	/** @inheritdoc */
	protected function getItems(): array
	{
		if( ! is_array($this->attributes)){
			$this->attributes = [];
		}
		return $this->attributes;
	}

	/**
	 * Add attribute to collection
	 *
	 * @param Attribute $attribute
	 *
	 * @return Attributes
	 */
	public function addAttribute(Attribute$attribute) : Attributes
	{
		$this->getItems();//max sure is array
		$this->attributes[$attribute->getName()] = $attribute;
		return $this;
	}

	public function has($attributeName): bool
	{
		return array_key_exists($attributeName,$this->getItems());
	}

}
