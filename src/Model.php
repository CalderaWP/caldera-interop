<?php


namespace calderawp\interop;

use calderawp\interop\Traits\ConvertsInteropModelToArray;
use calderawp\interop\Traits\CreatesInteropModelFromArray;
use calderawp\interop\Contracts\InteroperableModelContract as ModelContract;
use calderawp\interop\Contracts\Interoperable;
use calderawp\interop\Contracts\Rest\RestRequestContract;
use calderawp\interop\Contracts\Rest\RestResponseContract;
use calderawp\interop\Traits\ProvidesIdToModel;
use calderawp\interop\Traits\ProvidesName;
use calderawp\interop\Traits\Rest\ProvidesRestResponse;

abstract class Model implements ModelContract
{
	use CreatesInteropModelFromArray,ConvertsInteropModelToArray,ProvidesIdToModel,ProvidesName;


	public function toResponse(int$statusCode = 200): RestResponseContract
	{
		$response = new class implements RestResponseContract {
			use ProvidesRestResponse;
		};
		$response->setStatus($statusCode);
		$response->setData($this->toArray());
		return $response;
	}

	public static function fromRequest(RestRequestContract $request): Interoperable
	{
		return static::fromArray($request->getParams());
	}

	public function jsonSerialize()
	{
		return $this->toArray();
	}
}
