<?php


namespace calderawp\interop;

use calderawp\interop\Contracts\InteroperableEntityContract;
use calderawp\interop\Traits\ProvidesValue;

abstract class Entity implements InteroperableEntityContract
{
	use ProvidesValue;
}
