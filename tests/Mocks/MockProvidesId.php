<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Contracts\HasId;
use calderawp\interop\Traits\ProvidesIdToModel;

class MockProvidesId extends MockCaldera implements HasId
{
	use ProvidesIdToModel;

}
