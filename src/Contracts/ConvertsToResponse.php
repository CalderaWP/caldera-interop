<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Contracts\Rest\RestResponseContract;

interface ConvertsToResponse
{
	/**
	 * Convert object to REST response
	 *
	 * @return RestResponseContract
	 */
	public function toResponse(): RestResponseContract;
}
