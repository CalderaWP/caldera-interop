<?php


namespace calderawp\interop\Tests\Mocks;


use calderawp\interop\Contracts\Rest\RestResponseContract;
use calderawp\interop\Traits\CollectsModels;
use calderawp\interop\Contracts\InteroperableModelContract;
use calderawp\interop\Contracts\InteroperableCollectionContract;
use calderawp\interop\Traits\IteratesArray;

class MockModelCollection implements InteroperableCollectionContract
{

	use CollectsModels;
	protected $fields;


	public function toResponse(): RestResponseContract
	{
		return MockRestResponse::fromArray($this->toArray());
	}

	public function setHats(InteroperableModelContract $model)
	{
		$this->items[$model->getId()] = $model;
	}


	protected function setterName(): string
	{
		return 'setHats';
	}
}
