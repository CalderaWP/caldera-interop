<?php

namespace calderawp\interop\Collections;


use calderawp\interop\Arrayable\JsonArrayable;

abstract class Collection implements JsonArrayable
{
	/** @inheritdoc */
	public function jsonSerialize()
	{
		return $this->toArray();
	}

}