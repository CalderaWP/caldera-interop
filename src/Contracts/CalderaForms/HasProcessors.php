<?php


namespace calderawp\interop\Contracts\CalderaForms;
use calderawp\interop\Contracts\ProcessorContract as Processor;
use calderawp\interop\Contracts\ProcessorCollectionContract as Processors;


interface HasProcessors
{

	/**
	 * Get the processors collection
	 *
	 * @return Processors
	 */
	public function getProcessors() : Processors;

	/**
	 * (re)Set the processors collection
	 *
	 * @param Processors $processors
	 *
	 * @return HasProcessors
	 */
	public function setProcessors(Processors $processors) : HasProcessors;

}
