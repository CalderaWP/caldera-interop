<?php


namespace calderawp\interop\Providers;

use calderawp\interop\Interfaces\CalderaFormsApp;
use calderawp\interop\Interfaces\ProvidesInteropService;

/**
 * Class InteropProvider
 *
 * Handy implementation of ProvidesInteropService that auto-wires the binding
 *
 */
abstract class InteropProvider implements ProvidesInteropService
{


	/** @inheritdoc */
	public function bindInterop(CalderaFormsApp $calderaFormsApp)
	{
		$calderaFormsApp
			->getFactory()
			->bindInterop(
				//Alias that identifies these objects in container
				$this->getAlias(),
				$this->getEntityClassRef(),
				//Name of model class
				$this->getModelClassRef(),
				//Name of collection class
				$this->getCollectionClassRef()
			);

		return $this;
	}

	/** @inheritdoc */
	abstract protected function getEntityClassRef();

	/** @inheritdoc */
	abstract protected function getModelClassRef();

	/** @inheritdoc */
	abstract protected function getCollectionClassRef();
}
