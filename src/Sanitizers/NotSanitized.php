<?php


namespace calderawp\interop\Sanitizers;

use calderawp\interop\Interfaces\SanitizesValue;

/**
 * Class NotSanitized
 *
 * Sanitizers that does not sanitize
 */
class NotSanitized implements SanitizesValue
{

	public function process($value)
	{
		return $value;
	}
}
