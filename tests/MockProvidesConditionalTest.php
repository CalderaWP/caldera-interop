<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockProvidesConditional;
use calderawp\interop\Contracts\CalderaForms\HasConditional;

class MockProvidesConditionalTest extends TestCase
{
	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesConditional::getConditional()
	 */
	public function testGetConditional()
	{
		$model = new MockProvidesConditional();
		$conditional = \Mockery::mock( 'Conditional', HasConditional::class );

		$model->setConditional( $conditional );
		$this->assertSame($conditional, $model->getConditional() );
	}

	/**
	 * @covers \calderawp\interop\Traits\CalderaForms\ProvidesConditional::setConditional()
	 */
	public function testSetConditional()
	{
		$model = new MockProvidesConditional();
		$conditional = \Mockery::mock( 'Conditional', HasConditional::class );

		$model->setConditional( $conditional );
		$this->assertAttributeEquals($conditional, 'conditional', $model );
	}
}
