<?php

namespace calderawp\interop;

use calderawp\CalderaContainers\Interfaces\ServiceContainer;
use calderawp\interop\CalderaForms\Entry\EntryEntity;
use calderawp\interop\CalderaForms\Entry\EntryFieldEntity;
use calderawp\interop\CalderaForms\Entry\EntryMetaEntity;
use calderawp\interop\CalderaForms\Form\FormEntity as FormEntity;
use calderawp\interop\CalderaForms\Form\FormModel;
use calderawp\interop\CalderaForms\Processors\ProcessorTypeEntity;
use calderawp\interop\CalderaForms\Settings\GeneralSettingsEntity;
use calderawp\interop\CalderaForms\Settings\PrivacySettingsEntity;
use calderawp\interop\Contracts\CalderaFormsInteropComponent;
use calderawp\interop\Contracts\CalderaInteroperableComponent;

/**
 * Class CalderaForms
 *
 * The "app" that encapsulates Caldera Forms interop features
 *
 * @package calderawp\interop
 */
class CalderaFormsInterop extends \calderawp\CalderaContainers\Container implements CalderaInteroperableComponent
{

	const TRANSFORMER = 'TRANSFORMER';
	const COLLECTION = 'COLLECTION';
	/**
	 * @var \calderawp\CalderaContainers\Service\Container
	 */
	private $serviceContainer;

	public function __construct(ServiceContainer $serviceContainer)
	{
		$this->serviceContainer = $serviceContainer;
		$this->setupServiceContainer();
	}

	/**
	 * Get main forms collection
	 *
	 * @return Collection
	 */
	public function getFormsCollection()
	{
		return $this->serviceContainer->make(FormEntity::class);
	}

	/**
	 * Get main processors collection
	 *
	 * @return Collection
	 */
	public function getProcessorTypesCollection()
	{
		return $this->serviceContainer->make(ProcessorTypeEntity::class);
	}

	/**
	 * Setup the service container
	 */
	public function setupServiceContainer()
	{
		$this->serviceContainer->bind(self::COLLECTION, function () {
			return new Collection();
		});

		$this->serviceContainer->bind(PrivacySettingsEntity::class, function () {
			return new PrivacySettingsEntity();
		});
		$this->serviceContainer->bind(EntryEntity::class, function () {
			return new EntryEntity();
		});
		$this->serviceContainer->bind(EntryFieldEntity::class, function () {
			return new EntryFieldEntity();
		});
		$this->serviceContainer->bind(EntryMetaEntity::class, function () {
			return new EntryMetaEntity();
		});

		$this->serviceContainer->singleton(GeneralSettingsEntity::class, function () {
			return new GeneralSettingsEntity();
		});

		//Form collection
		$this->serviceContainer->singleton(FormEntity::class, function () {
			return $this->collectionFactory([], FormEntity::class);
		});

		//Processor type collection
		$this->serviceContainer->singleton(ProcessorTypeEntity::class, function () {
			return $this->collectionFactory([], ProcessorTypeEntity::class);
		});
	}




	public function find($entityType, $id)
	{
		return new FormModel((new FormEntity())->setId($id), $this);
	}

	public function findBy($entityType, $field, $value)
	{
	}

	/**
	 * @return GeneralSettingsEntity
	 */
	public function getGeneralSettings()
	{
		return $this->serviceContainer->make(GeneralSettingsEntity::class);
	}

	/**
	 * @return EntryEntity
	 */
	public function newEntry()
	{
		return $this->serviceContainer->make(EntryEntity::class);
	}

	/**
	 * @return EntryFieldEntity
	 */
	public function newEntryField()
	{
		return $this->serviceContainer->make(EntryFieldEntity::class);
	}

	/**
	 * @return EntryMetaEntity
	 */
	public function newEntryMetaField()
	{
		return $this->serviceContainer->make(EntryMetaEntity::class);
	}

	/**
	 * Add a form to the collection
	 *
	 * @param FormEntity $form
	 * @return Collection
	 */
	public function addForm(FormEntity $form)
	{
		return $this->getFormsCollection()->addEntity($form);
	}

	/**
	 * Create a new, empty FormEntity
	 *
	 * @param string $id
	 * @return FormEntity
	 */
	public function createForm($id = '')
	{
		if (! $id) {
			$id = uniqid('cf');
		}
		return (new FormEntity() )->setId($id);
	}

	/**
	 * Get a form from the collection
	 *
	 * @param $formId
	 * @return FormEntity|null
	 */
	public function getForm($formId)
	{
		return $this->getFormsCollection()->containsKey($formId)
			? $this->getFormsCollection()->get($formId)
			: null;
	}

	/**
	 * @param array $data
	 * @return Collection
	 */
	public function collectionFactory(array $data = [], $type)
	{
		return (new Collection($data))->setType($type);
	}
}
