<?php


namespace calderawp\interop;

use calderawp\CalderaContainers\Interfaces\ServiceContainer;
use calderawp\interop\Collections\EntityCollections\EntryValues\Fields;
use calderawp\interop\Entities\Entry;
use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\InteroperableFactory;
use calderawp\interop\Interfaces\ProvidesService;
use calderawp\interop\Models\Form;
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
				'field',
				\calderawp\interop\Entities\Field::class,
				\calderawp\interop\Models\Field::class,
				\calderawp\interop\Collections\EntityCollections\Fields::class
			);

		$this
			->getFactory()
			->bindInterop(
				'form',
				\calderawp\interop\Entities\Form::class,
				\calderawp\interop\Models\Form::class,
				\calderawp\interop\Collections\EntityCollections\Forms::class
			);

		$this
			->getFactory()
			->bindInterop(
				'entry',
				[
					\calderawp\interop\Entities\Entry::class,
					function(){
						return new Entry(new Entry\Details(), new Fields(), new \calderawp\interop\Entities\Form( ) );
					}
				],
				\calderawp\interop\Models\Entry::class,
				\calderawp\interop\Collections\EntityCollections\Entries::class
			);
	}
}
