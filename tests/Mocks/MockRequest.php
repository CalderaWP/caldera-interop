<?php


namespace calderawp\interop\Tests\Mocks;
use calderawp\interop\Contracts\Rest\RestRequestContract;
use calderawp\interop\Traits\Rest\ProvidesHttpHeaders;
use calderawp\interop\Traits\Rest\ProvidesRestParams;


class MockRequest implements  RestRequestContract
{

	use ProvidesRestParams, ProvidesHttpHeaders;
}
