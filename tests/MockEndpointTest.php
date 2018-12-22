<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockEndpoint;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

class MockEndpointTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRestEndpoint::getHttpMethod()
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRestEndpoint::setHttpMethod()
	 */
	public function testSetHttpMethod()
	{
		$endpoint = new MockEndpoint();
		$method = 'POST';
		$endpoint->setHttpMethod($method);
		$this->assertEquals($method, $endpoint->getHttpMethod());
		$this->assertAttributeEquals($method,'httpMethod', $endpoint);
	}
	/**
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRestEndpoint::getHttpMethod()
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRestEndpoint::setHttpMethod()
	 */
	public function testSetUri()
	{
		$endpoint = new MockEndpoint();
		$uri = '/hats/bats/<id>';
		$endpoint->setUri($uri);
		$this->assertEquals($uri, $endpoint->getUri());
		$this->assertAttributeEquals($uri,'uri', $endpoint);
	}
	/**
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRestEndpoint::getArgs()
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRestEndpoint::setArgs()
	 */
	public function testSetArgs()
	{
		$endpoint = new MockEndpoint();
		$args = [
			'formId' => [
				'type' => 'integer'
			]
		];
		$endpoint->setArgs($args);
		$this->assertEquals($args, $endpoint->getArgs());
		$this->assertAttributeEquals($args,'args', $endpoint);
	}
}
