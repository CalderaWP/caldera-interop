<?php


namespace calderawp\interop\Providers;

use calderawp\CalderaContainers\Interfaces\ServiceContainer;
use calderawp\interop\CalderaForms;
use calderawp\interop\Interfaces\ProvidesService;
use calderawp\interop\Submissions\Collection;

class SubmissionsProvider implements ProvidesService
{

	const ALIAS =  'cf.SUBMISSION';

	/** @inheritdoc */
	public function registerService(ServiceContainer $container)
	{
		$container->singleton($this->getAlias(), function () use ($container) {
			return new Collection(
				$container->make(CalderaForms::CALDERA_FORMS)
			);
		});
	}

	/** @inheritdoc */
	public function getAlias()
	{
		return self::ALIAS;
	}
}
