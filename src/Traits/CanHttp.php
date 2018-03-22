<?php


namespace calderawp\interop\Traits;


use calderawp\interop\Interfaces\Interoperable;
use Psr\Http\Message\RequestInterface as Request;


trait CanHttp
{

    /**
     * Convert from request to array
     *
     * @return Interoperable
     */
    public static function fromRequest(Request $request)
    {
        $body = json_decode($request->getBody()->getContents());
        return self::fromArray($body);
    }

    /**
     * @return \calderawp\interop\Http\Response
     */
    public function toResponse()
    {
        return new \calderawp\interop\Http\Response($this->toArray());
    }

}