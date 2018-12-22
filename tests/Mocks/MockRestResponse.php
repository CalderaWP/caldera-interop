<?php


namespace calderawp\interop\Tests\Mocks;

use calderawp\interop\Contracts\Rest\RestResponseContract;
use calderawp\interop\Traits\Rest\ProvidesRestResponse;


class MockRestResponse implements RestResponseContract
{
	use ProvidesRestResponse;
}
