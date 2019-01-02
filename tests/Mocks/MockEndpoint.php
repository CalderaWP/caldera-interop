<?php


namespace calderawp\interop\Tests\Mocks;

use calderawp\caldera\Events\Filters;
use calderawp\caldera\restApi\Exception;
use calderawp\interop\Contracts\Rest\Endpoint;
use calderawp\interop\Contracts\Rest\RestRequestContract as Request;
use calderawp\interop\Contracts\Rest\RestResponseContract as Response;
use calderawp\interop\Contracts\TokenContract;
use calderawp\interop\Contracts\WordPress\ApplysFilters;
use calderawp\interop\Traits\Rest\ProvidesRestEndpoint;

class MockEndpoint extends MockCaldera implements Endpoint
{
	/**
	 * @inheritDoc
	 */
	public function getToken(Request $request): string
	{
		return 'fds';
	}

	use ProvidesRestEndpoint;


	public function getFilters(): ApplysFilters
	{
		return new Filters();
	}


	public function handleRequest(Request $request): Response
	{
		return new \calderawp\caldera\restApi\Response();
	}

	public function authorizeRequest(Request $request): bool
	{
		return true;
	}

}
