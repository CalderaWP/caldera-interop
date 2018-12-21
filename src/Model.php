<?php


namespace calderawp\interop;

use calderawp\interop\Traits\ConvertsInteropModelToArray;
use calderawp\interop\Traits\CreatesInteropModelFromArray;
use calderawp\interop\Contracts\InteroperableModelContract as ModelContract;
use calderawp\interop\Contracts\Interoperable;
use calderawp\interop\Contracts\RestRequestContract;
use calderawp\interop\Contracts\RestResponseContract;
use calderawp\interop\Traits\ProvidesIdToModel;
use calderawp\interop\Traits\ProvidesName;

abstract class Model implements ModelContract
{
	use CreatesInteropModelFromArray,ConvertsInteropModelToArray,ProvidesIdToModel,ProvidesName;


	public function toResponse(): RestResponseContract
	{
		// TODO: Implement toResponse() method.
	}

	public static function fromRequest(RestRequestContract $request): Interoperable
	{
		// TODO: Implement fromRequest() method.
	}

	public function jsonSerialize()
	{
		return $this->toArray();
	}
}
