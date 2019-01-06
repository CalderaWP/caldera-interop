<?php


namespace calderawp\interop\Contracts;

use calderawp\caldera\Forms\DataSources\FormsDataSources;
use calderawp\caldera\DataSource\Contracts\SourceContract as Source;
use calderawp\interop\Contracts\WordPress\ApplysFilters;

interface FiltersDataSource
{
	/**
	 * Add the hooks
	 *
	 * @param ApplysFilters $filters
	 */
	public function addHooks(ApplysFilters $filters) :void;
}
