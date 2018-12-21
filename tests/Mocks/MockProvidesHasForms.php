<?php


namespace calderawp\interop\Tests\Mocks;


use calderawp\interop\Contracts\CalderaForms\HasForms;
use calderawp\interop\Traits\CalderaForms\ProvidesForms;

class MockProvidesHasForms extends MockCaldera implements HasForms
{

	use ProvidesForms;

	/**
	 * @var HasForms
	 */
	protected $forms;

}
