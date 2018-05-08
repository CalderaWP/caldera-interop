<?php


namespace calderawp\interop\Providers;

use calderawp\interop\CalderaForms;
use calderawp\interop\Collections\EntityCollections\EntryValues\Fields;
use calderawp\interop\Entities\Entry\Details;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\ProvidesInteropService;

/**
 * Class EntryInteroperableProvider
 *
 * Provides entry interop set through the CalderaFormsApp service factory
 */
class EntryInteroperableProvider implements ProvidesInteropService
{

	/** @inheritdoc */
	public function bindInterop(CalderaFormsApp $calderaFormsApp)
	{
		$calderaFormsApp
			->getFactory()
			->bindInterop(
				$this->getAlias(),
				[
					\calderawp\interop\Entities\Entry::class,
					function () {
						return new \calderawp\interop\Entities\Entry(
							new Details(),
							new Fields(),
							new \calderawp\interop\Entities\Form()
						);
					}
				],
				\calderawp\interop\Models\Entry::class,
				\calderawp\interop\Collections\EntityCollections\Entries::class
			);
	}

	/** @inheritdoc */
	public function getAlias()
	{
		return CalderaForms::ENTRY;
	}
}
