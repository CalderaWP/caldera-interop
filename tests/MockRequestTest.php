<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockRequest;
use PHPUnit\Framework\TestCase;

class MockRequestTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Traits\Rest\ProvidesHttpHeaders::getHeader()
	 * @covers \calderawp\interop\Traits\Rest\ProvidesHttpHeaders::setHeader()
	 */
	public function testGetSetHeader()
	{
		$request = new MockRequest();
		$request->setHeader('X-TOTAL', 4 );
		$request->setHeader('X-ROY', 'roy' );
		$request->setHeader('X-CACHE', 'always' );
		$this->assertTrue($request->hasHeader('X-ROY') );
		$this->assertEquals('roy', $request->getHeader('X-ROY') );
	}

	/**
	 * @covers \calderawp\interop\Traits\Rest\ProvidesHttpHeaders::hasHeader()
	 * @covers \calderawp\interop\Traits\Rest\ProvidesHttpHeaders::setHeader()
	 */
	public function hasHeaderTest()
	{

		$request = new MockRequest();
		$request->setHeader('X-TOTAL', 4 );
		$request->setHeader('X-Roy', 'roy' );
		$this->assertTrue( $request->hasHeader( 'X-ROY') );
		$this->assertFalse( $request->hasHeader( 'X-NOT-ROY') );

	}

	/**
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRestParams::getParam()
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRestParams::setParam()
	 */
	public function testGetSetParams()
	{
		$request = new MockRequest();
		$request->setParam('aa', 'x11f' );
		$request->setParam('testParam', 'xf' );
		$request->setParam('bb', [1,'xc', 'aa'] );
		$this->assertEquals('xf', $request->getParam('testParam') );

	}


}
