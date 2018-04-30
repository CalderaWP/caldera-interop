<?php

class CalderaFormsTest extends CalderaInteropTestCase
{

	/**
	 *
	 * @covers CalderaForms::registerInterops()
	 * @covers CalderaForms::getFactory()
	 */
	public function testFactory()
	{
		$calderaForms = $this->createApp();

		$this->assertSame(
			\calderawp\interop\Entities\Field::class,
			get_class(
				$calderaForms
				->getFactory()
				->entity( 'field' )
			)
		);

	}

	/**
	 * Test service providing/registration
	 *
	 * @covers CalderaForms::registerProvider()
	 * @covers CalderaForms::getService()
	 * @covers ServiceContainer::make()
	 */
	public function testServiceRegistration()
	{
		$calderaForms = $this->createApp();
		$provider = new \calderawp\interop\Mock\Provider();
		$calderaForms->registerProvider($provider);
		$this->assertEquals(
			new stdClass(),
			$calderaForms->getService($provider->getAlias() )
		);

	}

	/**
	 * @return \calderawp\interop\CalderaForms
	 */
	protected function createApp()
	{
		$interopContainer = new \calderawp\interop\Service\Container();
		$factory = new \calderawp\interop\Service\Factory($interopContainer);
		$serviceContainer = new \calderawp\CalderaContainers\Service\Container();
		$calderaForms = new \calderawp\interop\CalderaForms($factory, $serviceContainer);
		return $calderaForms;
	}
}