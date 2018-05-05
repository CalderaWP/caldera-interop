<?php


namespace calderawp\interop\Interfaces;

interface SanitizesValue
{


	/**
	 * Process value
	 *
	 * @param mixed $value
	 * @return mixed
	 */
	public function process($value);
}
