<?php


namespace calderawp\interop;

use calderawp\interop\Traits\CalderaForms\ProvidesForms;
use calderawp\interop\Traits\ProvidesSettings;
use calderawp\interop\Contracts\CalderaContract;

abstract class Caldera extends Model implements CalderaContract
{
	use ProvidesForms,ProvidesSettings;
}
