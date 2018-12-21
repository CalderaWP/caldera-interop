<?php


namespace calderawp\interop;

use calderawp\interop\Contracts\InteroperableCollectionContract;
use calderawp\interop\Traits\CollectsModels;
use calderawp\interop\Traits\CreatesCollectionFromArray;

abstract class Collection implements InteroperableCollectionContract
{
	use CollectsModels;
}
