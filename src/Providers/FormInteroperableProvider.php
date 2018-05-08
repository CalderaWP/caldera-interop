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
class FormInteroperableProvider extends InteropProvider
{

	/** @inheritdoc */
	public function getAlias()
	{
		return CalderaForms::FORM;
	}

	/** @inheritdoc */
	protected function getEntityClassRef()
	{
		return \calderawp\interop\Entities\Form::class;
	}

	/** @inheritdoc */
	protected function getModelClassRef()
	{
		return \calderawp\interop\Models\Form::class;
	}

	/** @inheritdoc */
	protected function getCollectionClassRef()
	{
		return \calderawp\interop\Collections\EntityCollections\Forms::class;
	}
}
