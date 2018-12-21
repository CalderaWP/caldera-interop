<?php


namespace calderawp\interop\Tests\Mocks;

use calderawp\interop\Traits\CreatesInteropModelFromArray;

class MockCreatesInteroperableFromArray extends MockCaldera
{

	use CreatesInteropModelFromArray;

	protected $one;
	protected $two;
	protected $otherProp;


	public function setOtherProp(int $value)
	{
		$this->otherProp = 2 + $value;
	}

}
