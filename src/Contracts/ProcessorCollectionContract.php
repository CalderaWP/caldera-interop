<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Contracts\ProcessorContract as Processor;

interface ProcessorCollectionContract extends InteroperableCollectionContract
{
	public function addProcessor(Processor $processor) : ProcessorCollectionContract;
	public function hasProcessorOfType(string  $processorType): bool;
}
