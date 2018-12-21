<?php


namespace calderawp\interop\Tests\Mocks;


use calderawp\interop\Contracts\CalderaForms\HasForm;
use calderawp\interop\Traits\CalderaForms\ProvidesForm;

class MockProvidesHasForm extends MockCaldera implements HasForm
{

	use ProvidesForm;

	/**
	 * @var HasForm
	 */
	protected $form;

}
