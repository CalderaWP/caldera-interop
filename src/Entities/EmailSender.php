<?php


namespace calderawp\interop\Entities;

/**
 * Class EmailSender
 *
 * Object representation of sender of email
 *
 * @package calderawp\interop\Entities
 */
class EmailSender extends EmailAddress
{

	/** @inheritdoc */
	public static function getType()
	{
		return 'email.sender';
	}
}
