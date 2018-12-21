<?php


namespace calderawp\interop\Tests\Mocks;

use calderawp\interop\Contracts\HasSlug;
use calderawp\interop\Traits\ProvidesSlug;

class MockHasSlug implements HasSlug
{

	use ProvidesSlug;
}
