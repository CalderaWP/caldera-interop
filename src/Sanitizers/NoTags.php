<?php


namespace calderawp\interop\Sanitizers;

use calderawp\interop\Interfaces\SanitizesValue;

/**
 * Class NoTags
 *
 * Strips tags from values
 */
class NoTags implements SanitizesValue
{

	public function process($value)
	{
		return strip_tags($value);
	}
}
