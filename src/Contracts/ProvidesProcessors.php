<?php


namespace calderawp\interop\Contracts;

use calderawp\caldera\Forms\Processing\ProcessorCollection;
use calderawp\interop\Contracts\ProcessorContract as Processor;
use calderawp\interop\Contracts\ProcessorCollectionContract as Processors;
use calderawp\interop\Contracts\CalderaForms\HasProcessors;

/**
 * Trait ProvidesProcessors
 *
 * Provides implementation of methods that interface calderawp\interop\Contracts\CalderaForms\HasProcessors requires.
 *
 * Primary implementation:
 * @see /caldera/php-packages/forms/src/Processing/ProcessorCollection.php
 */
trait ProvidesProcessors
{

	/**
	 * @var Processors
	 */
	protected $processors;

	/**
	 * Get the processors collection
	 *
	 * @return Processors
	 */
	public function getProcessors() : Processors
	{
		if (! $this->processors) {
			$this->processors = new ProcessorCollection();
		}
		return $this->processors;
	}

	/**
	 * (re)Set the processors collection
	 *
	 * @param Processors $processors
	 *
	 * @return HasProcessors
	 */
	public function setProcessors(Processors $processors) : HasProcessors
	{
		$this->processors = $processors;
		return $this;
	}
}
