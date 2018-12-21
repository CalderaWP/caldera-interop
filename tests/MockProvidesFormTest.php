<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesHasForm;
use calderawp\interop\Contracts\CalderaForms\HasForm;

class MockProvidesFormTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesForm::setForm();
	 */
	public function testSetForm()
	{
		$form = \Mockery::mock('Form', HasForm::class );
		$hasForm = new MockProvidesHasForm();
		$hasForm->setForm($form);
		$this->assertAttributeEquals($form, 'form', $hasForm);
	}

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesForm::getForm();
	 */
	public function testGetForm()
	{
		$form = \Mockery::mock('Form', HasForm::class );
		$hasForm = new MockProvidesHasForm();
		$hasForm->setForm($form);
		$this->assertSame($form, $hasForm->getForm() );
	}
}
