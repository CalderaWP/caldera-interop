<?php


namespace calderawp\interop\Providers;

use calderawp\CalderaContainers\Interfaces\ServiceContainer;
use calderawp\interop\Entities\Form;
use calderawp\interop\Entities\Field;
use calderawp\interop\Entities\EmailSender;
use calderawp\interop\Entities\EmailRecipient;
use calderawp\interop\Entities\EmailReplyTo;
use calderawp\interop\Entities\Entry;
use calderawp\interop\Entities\Message;
use calderawp\interop\Interfaces\ProvidesService;
use calderawp\interop\Service\Container;

/**
 * Class EntityProvider
 *
 * Used to bind entities to container
 *
 * @package calderawp\interop\Providers
 */
class EntityProvider implements ProvidesService
{

	/**
	 * Register all entities in container
	 *
	 * @param Container $container
	 */
	public function registerService(ServiceContainer $container)
	{
		$container->bind(Form::class, function () {
			return new Form();
		});
		$container->bind(Field::class, function () {
			return new Field();
		});
		$container->bind(EmailReplyTo::class, function () {
			return new EmailReplyTo();
		});
		$container->bind(EmailRecipient::class, function () {
			return new EmailRecipient();
		});
		$container->bind(EmailSender::class, function () {
			return new EmailSender();
		});
		$container->bind(Message::class, function () {
			return new Message();
		});
		$container->bind(Entry\Details::class, function () {
			return new Entry\Details();
		});

		$container->bind(Entry\Field::class, function () {
			return new Entry\Field();
		});
	}
}
