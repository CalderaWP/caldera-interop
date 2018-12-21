<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Contracts\CalderaForms\HasFields;
use calderawp\interop\Traits\CalderaForms\ProvidesFields;

class MockProvidesHasFields extends MockCaldera implements HasFields
{

	use ProvidesFields;

}
