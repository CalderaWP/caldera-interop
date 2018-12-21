<?php


namespace calderawp\interop\Tests\Mocks;

use calderawp\interop\Contracts\CalderaForms\HasConditionals;
use calderawp\interop\Traits\CalderaForms\ProvidesConditionals;

class MockProvidesConditionals extends MockCaldera implements HasConditionals
{

	use ProvidesConditionals;

}
