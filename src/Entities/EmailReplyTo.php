<?php


namespace calderawp\interop\Entities;

/**
 * Class EmailReplyTo
 *
 * Object representation of email Reply-to
 *
 * @package calderawp\interop\Entities
 */
class EmailReplyTo extends EmailAddress
{
	/** @inheritdoc */
	public static function getType()
	{
		return 'email.replyTo';
	}
}
