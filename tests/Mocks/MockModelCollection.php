<?php


namespace calderawp\interop\Tests\Mocks;


use calderawp\interop\Traits\CollectsModels;
use calderawp\interop\Contracts\InteroperableModelContract;
use calderawp\interop\Contracts\InteroperableCollectionContract;

class MockModelCollection implements InteroperableCollectionContract
{

	use CollectsModels;


	public function setHats(InteroperableModelContract $model)
	{
		$this->items[$model->getId()] = $model;
	}


	protected function setterName(): string
	{
		return 'setHats';
	}
}
