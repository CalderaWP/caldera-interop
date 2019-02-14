<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Attribute;
use calderawp\interop\Collections\Attributes;

class AttributesTest extends TestCase
{

	public function testAddAttribute()
	{
		$name = 'hats';
		$collection = new Attributes();
		$attribute = new Attribute();
		$attribute->setName($name);
		$collection->addAttribute($attribute);
		$this->assertEquals(1, $collection->count() );
		$this->assertAttributeEquals( ['hats' => $attribute], 'attributes', $collection );
	}
}
