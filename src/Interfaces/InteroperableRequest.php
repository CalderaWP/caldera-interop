<?php


namespace calderawp\interop\Interfaces;

use Psr\Http\Message\RequestInterface;

/**
 * Interface InteroperableRequest
 *
 * Interface that objects representing HTTP requests MUST impliment
 * @package calderawp\interop\Interfaces
 */
interface InteroperableRequest extends Interoperable, RequestInterface
{
}
