<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockRestResponse;
use PHPUnit\Framework\TestCase;

class MockRestResponseTest extends TestCase
{

	/**
	 * @covers
	 */
	public function testGetSetHeaders()
	{
		$headers = [
			'X-CACHE' => 'tacos'
		];
		$response = new MockRestResponse();
		$response->setHeaders($headers);
		$this->assertAttributeEquals($headers, 'headers', $response);
		$this->assertEquals($headers, $response->getHeaders() );

	}

	public function testGetSetData()
	{
		$data = [
			'x' => 1,
			'hi' => 'Roy'
		];
		$response = new MockRestResponse();
		$response->setData($data);
		$this->assertAttributeEquals($data, 'data', $response);
		$this->assertEquals($data, $response->getData() );


	}

	public function testGetSetStatus()
	{
		$response = new MockRestResponse();
		$response->setStatus(500);
		$this->assertAttributeEquals(500, 'status', $response);
		$this->assertEquals(500, $response->getStatus() );
	}
}
