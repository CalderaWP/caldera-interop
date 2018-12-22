<?php


namespace calderawp\interop;

use calderawp\caldera\restApi\Response;
use calderawp\interop\Contracts\InteroperableCollectionContract;
use calderawp\interop\Contracts\Rest\RestResponseContract;
use calderawp\interop\Traits\CollectsModels;
use calderawp\interop\Traits\CreatesCollectionFromArray;

abstract class Collection implements InteroperableCollectionContract
{
	use CollectsModels;


	public function toResponse(): RestResponseContract
	{
		return Response::fromArray([
			'data' => $this->toArray()
		]);
	}
}
