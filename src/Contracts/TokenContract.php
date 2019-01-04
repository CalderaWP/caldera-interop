<?php


namespace calderawp\interop\Contracts;

interface TokenContract
{
	/**
	 * Generate a token, returning its public
	 *
	 * @return string
	 */
	public function getToken() : string;

	/**
	 * Test if string is a valid public for a token of current manager
	 *
	 * @param string $tokenStringToValidate
	 *
	 * @return bool
	 */
	public function validateToken(string $tokenStringToValidate):bool;
}
