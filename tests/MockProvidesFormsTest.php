<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesHasForms;
use calderawp\interop\Contracts\CalderaForms\HasForms;

class MockProvidesFormsTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesForms::setForms();
	 */
	public function testSetForms()
	{
		$forms = \Mockery::mock('Forms', HasForms::class );
		$hasForms = new MockProvidesHasForms();
		$hasForms->setForms($forms);
		$this->assertAttributeEquals($forms, 'forms', $hasForms);
	}

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesForms::getForms();
	 */
	public function testGetForms()
	{
		$forms = \Mockery::mock('Forms', HasForms::class );
		$hasForms = new MockProvidesHasForms();
		$hasForms->setForms($forms);
		$this->assertSame($forms, $hasForms->getForms() );
	}
}
