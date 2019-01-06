<?php


namespace calderawp\interop\Traits;

use calderawp\caldera\DataSource\Contracts\SourceContract as Source;
use calderawp\caldera\Forms\DataSources\FormsDataSources;

trait ProvidesFormsDataSource
{
	/** @var FormsDataSources */
	protected $dataSources;




	/**
	 * Get a form, form entry or form entry value data source.
	 *
	 * @param string $source
	 *
	 * @return Source
	 */
	public function getDataSource(string  $source) : Source
	{
		switch ($source) {
			case 'form':
			case 'forms':
				return $this
					->getDataSources()
					->getFormsDataSource();
				break;
			case 'entry':
			case 'entries':
				return $this
					->getDataSources()
					->getEntryDataSource();
				break;
			case 'entryValue':
			case 'entryValues':
				return $this
					->getDataSources()
					->getEntryValuesDataSource();
		}
	}

	protected function getDataSources() : FormsDataSources
	{
		return $this->dataSources;
	}
}
