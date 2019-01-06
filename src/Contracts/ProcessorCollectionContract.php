<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Contracts\ProcessorContract as Processor;

interface ProcessorCollectionContract extends InteroperableCollectionContract
{
	/**
	 * Add a processor to collection
	 *
	 * @param ProcessorContract $processor
	 *
	 * @return ProcessorCollectionContract
	 */
	public function addProcessor(Processor $processor) : ProcessorCollectionContract;

	/**
	 * Check if form has any processors of given type
	 *
	 * @param string $processorType
	 *
	 * @return bool
	 */
	public function hasProcessorOfType(string  $processorType): bool;
}
