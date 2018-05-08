<?php


namespace calderawp\interop\Providers;

use calderawp\interop\CalderaForms;
use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\ProvidesInteropService;

/**
 * Class FormInteroperableProvider
 *
 * Provides forms through the CalderaFormsApp
 */
class FormInteroperableProvider implements ProvidesInteropService
{

	/** @inheritdoc */
	public function bindInterop(CalderaFormsApp $calderaFormsApp)
	{
		$calderaFormsApp
			->getFactory()
			->bindInterop(
				$this->getAlias(),
				\calderawp\interop\Entities\Form::class,
				\calderawp\interop\Models\Form::class,
				\calderawp\interop\Collections\EntityCollections\Forms::class
			);
	}

	/** @inheritdoc */
	public function getAlias()
	{
		return CalderaForms::FORM;
	}
}
