<?php


namespace calderawp\interop\Tests\Mocks;

use calderawp\interop\Contracts\Rest\Endpoint;
use calderawp\interop\Traits\Rest\ProvidesRestEndpoint;

class MockEndpoint extends MockCaldera implements Endpoint
{

	use ProvidesRestEndpoint;
}
