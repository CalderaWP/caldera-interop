<?php


namespace calderawp\interop\Interfaces;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

interface Interoperable
{

    /**
     * @param Request $request
     * @return Interoperable
     */
    public static function fromRequest(Request $request);

    /**
     * @return Response
     */
    public function toResponse();

    /**
     * @return bool
     */
    public function isValid();

    /**
     * @return array
     */
    public function toArray();
}
