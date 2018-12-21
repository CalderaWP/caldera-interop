<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Contracts\InteroperableModelContract;
use calderawp\interop\Traits\ProvidesId;

class MockProvidesId extends MockCaldera
	//implements InteroperableModelContract
{
	use ProvidesId;

}
