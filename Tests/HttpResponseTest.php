<?php


class HttpResponseTest extends CalderaInteropTestCase
{

    /**
     * Test setting body through constructor
     *
     * @covers \calderawp\interop\Http\Response::getBody()
     * @covers \calderawp\interop\Http\Response::setBody()
     * @covers \calderawp\interop\Http\Response::__construct()
     *
     * @group http
     */
    public function testBody()
    {
        $body = [ 'a' => 1, 6 ];
        $response = new \calderawp\interop\Http\Response( $body );
        $this->assertSame( json_encode($body), $response->getBody()->getContents() );
    }

    /**
     * Test resetting the body
     *
     * @covers \calderawp\interop\Http\Response::getBody()
     * @covers \calderawp\interop\Http\Response::setBody()
     *
     * @group http
     */
    public function testBodyReset()
    {
        $response = new \calderawp\interop\Http\Response([]);
        $body = [8,79,1];
        $response->setBody( $body );
        $this->assertSame( json_encode($body), $response->getBody()->getContents() );

    }

    /**
     * Test setting the status
     *
     * @covers \calderawp\interop\Http\Response::getStatusCode()
     * @covers \calderawp\interop\Http\Response::__construct()
     *
     * @group http
     */
    public function testStatus()
    {
        $response = new \calderawp\interop\Http\Response([], 404 );
        $this->assertSame( 404, $response->getStatusCode() );

    }

    /**
     * Test setting the reason phrase by status code
     *
     * @covers \calderawp\interop\Http\Response::getReasonPhrase()
     * @covers \calderawp\interop\Http\Response::setReasonPhrase()
     * @covers \calderawp\interop\Http\Response::__construct()
     *
     * @group http
     */
    public function testReasonPhrase()
    {
        $response = new \calderawp\interop\Http\Response([], 502 );
        $this->assertSame( 'Bad Gateway', $response->getReasonPhrase() );

    }

    /**
     * Test cloning to new status
     *
     * @covers \calderawp\interop\Http\Response::setReasonPhrase()
     * @covers \calderawp\interop\Http\Response::__construct()
     * @covers \calderawp\interop\Http\Response::withStatus()
     *
     * @group http
     */
    public function testWithStatus()
    {
        $body = json_encode( [8, new stdClass(), [ 5, 9  ] ] );
        $response = new \calderawp\interop\Http\Response( $body, 404 );
        $new = $response->withStatus( 202 );
        $this->assertSame( $body, $new->getBody()->getContents() );
        $this->assertSame( 202, $new->getStatusCode() );
        $this->assertSame( 'Accepted', $new->getReasonPhrase() );

    }

    /**
     * Test setting headers through construct
     *
     * @covers \calderawp\interop\Http\Response::__construct()
     *
     * @group http
     */
    public function testHeaders()
    {
        $headers = [
            'X-ONE' => 'one',
            'X-TWO' => 'two'
        ];
        $response = new \calderawp\interop\Http\Response( [], 404, $headers );

        $this->assertArrayHasKey( 'X-ONE', $response->getHeaders() );
        $this->assertArrayHasKey( 'X-TWO', $response->getHeaders() );
        $this->assertSame( 'one', $response->getHeaderLine( 'X-ONE' ) );
        $this->assertSame( 'two', $response->getHeaderLine( 'X-TWO' ) );
    }
}