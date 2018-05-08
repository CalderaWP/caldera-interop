<?php


namespace calderawp\interop\Providers;

use calderawp\interop\CalderaForms;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\ProvidesInteropService;

/**
 * Class FieldInteroperableProvider
 *
 * Provides field interop set through the CalderaFormsApp service factory
 */
class FieldInteroperableProvider implements ProvidesInteropService
{

	/** @inheritdoc */
	public function bindInterop(CalderaFormsApp $calderaFormsApp)
	{
		$calderaFormsApp
			->getFactory()
			->bindInterop(
				$this->getAlias(),
				\calderawp\interop\Entities\Field::class,
				\calderawp\interop\Models\Field::class,
				\calderawp\interop\Collections\EntityCollections\Fields::class
			);
	}

	/** @inheritdoc */
	public function getAlias()
	{
		return CalderaForms::FIELD;
	}
}
