<?php


namespace calderawp\interop\Tests\Mocks;

use calderawp\interop\Contracts\CalderaForms\HasConditional;
use calderawp\interop\Traits\CalderaForms\ProvidesConditional;

class MockProvidesConditional extends MockCaldera implements HasConditional
{

	use ProvidesConditional;

}
