<?php


namespace calderawp\interop\Providers;

use calderawp\interop\CalderaForms;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\ProvidesInteropService;

/**
 * Class EntryValueInteroperableProvider
 *
 * Provides entry value interop set through the CalderaFormsApp service factory
 */
class EntryValueInteroperableProvider implements ProvidesInteropService
{

	/** @inheritdoc */
	public function bindInterop(CalderaFormsApp $calderaFormsApp)
	{
		$calderaFormsApp
			->getFactory()
			->bindInterop(
				$this->getAlias(),
				\calderawp\interop\Entities\Entry\Field::class,
				\calderawp\interop\Models\Entry\Field::class,
				\calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class
			);
	}

	/** @inheritdoc */
	public function getAlias()
	{
		return CalderaForms::ENTRY_VALUE;
	}
}
