<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\CalderaForms\Entry\EntryEntity;
use calderawp\interop\CalderaForms\Entry\EntryFieldEntity;
use calderawp\interop\CalderaForms\Entry\EntryMetaEntity;
use calderawp\interop\CalderaForms\Form\FormEntity;
use calderawp\interop\CalderaForms\Settings\GeneralSettingsEntity;
use calderawp\interop\Collection;

interface CalderaFormsInteroperableComponent extends CalderaInteroperableComponent
{

	/**
	 * Get main forms collection
	 *
	 * @return Collection
	 */
	public function getFormsCollection();

	/**
	 * Get main processors collection
	 *
	 * @return Collection
	 */
	public function getProcessorTypesCollection();

	/**
	 * Get the General Settings for this Caldera Forms
	 *
	 * @return GeneralSettingsEntity
	 */
	public function getGeneralSettings();

	public function find($entityType, $id);

	public function findBy($entityType, $field, $value);

	/**
	 * Create a new EntryEntity object
	 *
	 * @return EntryEntity
	 */
	public function newEntry();

	/**
	 * Create a new entry EntryFieldEntity  object
	 *
	 * @return EntryFieldEntity
	 */
	public function newEntryField();
	/**
	 * @return EntryMetaEntity
	 */
	public function newEntryMetaField();

	/**
	 * Add a form to the form collection
	 *
	 * @param FormEntity $form
	 * @return Collection
	 */
	public function addForm(FormEntity $form);

	/**
	 * Create a new, empty FormEntity
	 *
	 * @param string $id
	 * @return FormEntity
	 */
	public function createForm($id = '');

	/**
	 * Get a form from the collection
	 *
	 * @param string $formId ID of form to get
	 * @return FormEntity|null
	 */
	public function getForm($formId);

	/**
	 * Create a new Collection
	 *
	 * @param array $data Array of entities for collection
	 * @param string $type The type of entity that collection collects
	 * @return Collection
	 */
	public function collectionFactory(array $data = [], $type);
}
