<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Contracts\CalderaForms\HasField;
use calderawp\interop\Traits\CalderaForms\ProvidesField;

class MockProvidesHasField extends MockCaldera implements HasField
{

	use ProvidesField;

}
