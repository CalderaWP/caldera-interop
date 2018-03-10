<?php


namespace calderawp\interop\Traits;

use calderawp\interop\Entities\EmailAddress;
use calderawp\interop\Entities\EmailRecipient;
use calderawp\interop\Entities\EmailReplyTo;
use calderawp\interop\Entities\EmailSender;
use calderawp\interop\Exceptions\Exception;

/**
 * Trait CanCastEmail
 *
 * Adds email casting to CanCastProps trait. Entities using this MUST also use CanCastProps
 *
 * @package calderawp\interop\Traits
 */
trait CanCastEmail
{

	/**
	 * Cast callback for EmailRecipient
	 *
	 * @param  EmailRecipient|EmailAddress|array|string $value Value to cast
	 * @return EmailRecipient|EmailAddress
	 */
	protected function castEmailRecipient($value)
	{
		return $this->emailCaster($value);
	}

	/**
	 * Cast callback for EmailSender
	 *
	 * @param  EmailSender|EmailAddress|array|string $value Value to cast
	 * @return EmailSender|EmailAddress
	 */
	protected function castEmailSender($value)
	{
		return $this->emailCaster($value, EmailSender::class);
	}

	/**
	 * Cast callback for EmailReplyTo
	 *
	 * @param  EmailReplyTo|EmailAddress|array|string $value Value to cast
	 * @return EmailReplyTo|EmailAddress
	 */
	protected function castEmailReplyTo($value)
	{
		return $this->emailCaster($value, EmailReplyTo::class);
	}



	/**
	 * @param EmailAddress|EmailRecipient|EmailReplyTo|string $value Email object or array/string to make an entity from.
	 * @param string                                          $type
	 *
	 * @return EmailAddress
	 * @throws  Exception
	 */
	protected function emailCaster($value, $type = EmailRecipient::class)
	{

		if (! is_a($value, $type)) {
			if (is_array($value)&&isset($value['email'])&&$this->isEmail($value['email'])) {
				$value = $type::fromArray($value);
			} elseif (is_string($value)&&$this->isEmail($value)) {
				$value = (new $type())->setEmail($value);
			} else {
				if (! is_scalar($value)) {
					$value = var_export($value, true);
				}
				throw new Exception(sprintf('Can not cast %s to %s', $value, $type));
			}
		}

		return $value;
	}

	private function isEmail($maybeEmail)
	{
		return filter_var($maybeEmail, FILTER_VALIDATE_EMAIL);
	}
}
