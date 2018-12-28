<?php

namespace calderawp\interop\Tests;

use calderawp\interop\Tests\Mocks\MockEndpoint;
use calderawp\interop\Tests\Mocks\MockRoute;
use PHPUnit\Framework\TestCase;

class MockRouteTest extends TestCase
{

	/**
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRoute::getEndpoints();
	 */
	public function testGetEndpoints()
	{
		$endpoint = new MockEndpoint();
		$route = new MockRoute();
		$route->addEndpoint($endpoint);
		$this->assertEquals(['calderawp\interop\Tests\Mocks\MockEndpoint' => $endpoint], $route->getEndpoints());
	}

	/**
	 * @covers \calderawp\interop\Traits\Rest\ProvidesRoute::addEndpoint();
	 */
	public function testAddEndpoint()
	{
		$endpoint = new MockEndpoint();
		$route = new MockRoute();
		$route->addEndpoint($endpoint);
		$this->assertAttributeEquals(['calderawp\interop\Tests\Mocks\MockEndpoint'=>$endpoint], 'endpoints', $route);
	}
}
