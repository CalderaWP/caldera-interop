<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesConditionals;
use calderawp\interop\Contracts\CalderaForms\HasConditionals;

class MockProvidesConditionalsTest extends TestCase
{
	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesConditionals::getConditionals()
	 */
	public function testSetConditionals()
	{
		$model = new MockProvidesConditionals();
		$conditionals = \Mockery::mock( 'Conditionals', HasConditionals::class );

		$model->setConditionals( $conditionals );
		$this->assertSame($conditionals, $model->getConditionals() );
	}
	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesConditionals::setConditionals()
	 */
	public function testGetConditionals()
	{
		$model = new MockProvidesConditionals();
		$conditionals = \Mockery::mock( 'Conditionals', HasConditionals::class );

		$model->setConditionals( $conditionals );
		$this->assertAttributeEquals($conditionals, 'conditionals', $model );
	}
}
