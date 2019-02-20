<?php


namespace calderawp\interop\Tests\Mocks;


use calderawp\interop\Attribute;
use calderawp\interop\ComplexEntity;

class MockComplexEntity extends ComplexEntity
{

	public function __construct()
	{
		$this->addAttribute((new Attribute())->setName('hats' ) );
	}

}
