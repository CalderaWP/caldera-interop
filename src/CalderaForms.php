<?php


namespace calderawp\interop;

use calderawp\CalderaContainers\Interfaces\ServiceContainer;
use calderawp\interop\Collections\EntityCollections\EntryValues\Fields;
use calderawp\interop\Entities\Entry;
use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\InteroperableFactory;
use calderawp\interop\Interfaces\ProvidesService;
use calderawp\interop\Service\Factory;

/**
 * Class CalderaForms
 *
 * The "app" that epsulates Caldera Forms interop features
 *
 * @package calderawp\interop
 */
class CalderaForms implements CalderaFormsApp
{
	const FIELD = 'field';
	const FORM = 'form';
	const ENTRY = 'entry';
	const ENTRY_VALUE = 'entry.value';
	const ENTRY_DETAILS = 'entry.details';
	const CALDERA_FORMS = 'CF';
	/**
	 * @var Factory
	 */
	private $interoperableFactory;

	/**
	 * @var ServiceContainer
	 */
	private $serviceContainer;

	/**
	 * CalderaForms constructor.
	 * @param InteroperableFactory $interoperableFactory
	 * @param ServiceContainer $serviceContainer
	 */
	public function __construct(InteroperableFactory$interoperableFactory, ServiceContainer $serviceContainer)
	{
		$this->interoperableFactory = $interoperableFactory;
		$this->serviceContainer = $serviceContainer;
		$this->bindSelf();
		$this->registerInterops();
	}

	/**
	 * Register a service
	 *
	 * @param ProvidesService $service
	 * @return ProvidesService
	 */
	public function registerProvider(ProvidesService $service)
	{
		$service->registerService($this->serviceContainer);
		return $service;
	}

	/**
	 * Get a registered service
	 *
	 * @param $alias
	 * @return mixed|object
	 * @throws ContainerException
	 */
	public function getService($alias)
	{
		if (! $this->serviceContainer->doesProvide($alias)) {
			throw new ContainerException(
				sprintf('Caldera Forms interop app does not provide %s service', $alias)
			);
		}
		return $this
			->serviceContainer
			->make($alias);
	}
	/**
	 * Get the interop factory
	 *
	 * @return InteroperableFactory|Factory
	 */
	public function getFactory()
	{
		return $this->interoperableFactory;
	}

	/**
	 * Register internal, default interops
	 */
	private function registerInterops()
	{

		$this
			->getFactory()
			->bindInterop(
				self::FIELD,
				\calderawp\interop\Entities\Field::class,
				\calderawp\interop\Models\Field::class,
				\calderawp\interop\Collections\EntityCollections\Fields::class
			);

		$this
			->getFactory()
			->bindInterop(
				self::FORM,
				\calderawp\interop\Entities\Form::class,
				\calderawp\interop\Models\Form::class,
				\calderawp\interop\Collections\EntityCollections\Forms::class
			);

		$this
			->getFactory()
			->bindInterop(
				self::ENTRY,
				[
					\calderawp\interop\Entities\Entry::class,
					function () {
						return new Entry(new Entry\Details(), new Fields(), new \calderawp\interop\Entities\Form());
					}
				],
				\calderawp\interop\Models\Entry::class,
				\calderawp\interop\Collections\EntityCollections\Entries::class
			);

		$this
			->getFactory()
			->bindInterop(
				self::ENTRY_VALUE,
				\calderawp\interop\Entities\Entry\Field::class,
				\calderawp\interop\Models\Entry\Field::class,
				\calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class
			);

		$this
			->getFactory()
			->bindInterop(
				self::ENTRY_DETAILS,
				\calderawp\interop\Entities\Entry\Details::class,
				\calderawp\interop\Models\Entry\Details::class,
				\calderawp\interop\Collections\EntityCollections\EntryValues\Details::class
			);
	}

	/**
	 * Attach a reference to this object to container
	 */
	private function bindSelf()
	{
		$this->serviceContainer->singleton(self::CALDERA_FORMS, $this);
	}
}
