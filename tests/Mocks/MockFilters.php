<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Traits\WordPress\ProvidesFilters;
use calderawp\interop\Contracts\WordPress\ApplysFilters;

class MockFilters implements ApplysFilters
{

	use ProvidesFilters;

}
