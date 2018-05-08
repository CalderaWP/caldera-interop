<?php


namespace calderawp\interop\Providers;

use calderawp\interop\CalderaForms;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\ProvidesInteropService;

/**
 * Class EntryDetailsInteroperableProvider
 *
 * Provides entry details interop set through the CalderaFormsApp service factory
 */
class EntryDetailsInteroperableProvider implements ProvidesInteropService
{

	/** @inheritdoc */
	public function bindInterop(CalderaFormsApp $calderaFormsApp)
	{
		$calderaFormsApp
			->getFactory()
			->bindInterop(
				$this->getAlias(),
				\calderawp\interop\Entities\Entry\Details::class,
				\calderawp\interop\Models\Entry\Details::class,
				\calderawp\interop\Collections\EntityCollections\EntryValues\Details::class
			);
	}

	/** @inheritdoc */
	public function getAlias()
	{
		return CalderaForms::ENTRY_DETAILS;
	}
}
