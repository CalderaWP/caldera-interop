<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Contracts\Rest\Route;
use calderawp\interop\Traits\Rest\ProvidesRoute;

class MockRoute implements Route
{
	use ProvidesRoute;
}
