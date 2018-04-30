<?php


namespace calderawp\interop\Service;

use calderawp\interop\Interfaces\InteroperableServiceContainer;

/**
 * Class Container
 *
 * Primary service container for interop. Should NOT be used directly. Designed to be injected into a service factory.
 *
 * @package calderawp\interop\Service
 */
class Container extends \calderawp\CalderaContainers\Service\Container implements InteroperableServiceContainer
{

}
