<?php


namespace calderawp\interop\Contracts;

use calderawp\interop\Contracts\InteroperableCollectionContract as Collection;

interface CreatesInteropCollectionsFromArray
{
	/**
	 * Create collection from array
	 *
	 * @param array $items
	 *
	 * @return static
	 */
	public static function fromArray(array  $items): Collection;
}
