<?php

/**
 * Class ModelTest
 *
 * The FormModel and FieldModel tests cover functionality of Model, but not toResponse(), which is covered here.
 *
 * @covers \calderawp\interop\Models\Model
 *
 */
class ModelTest extends ModelCalderaInteropTestCase
{

    /**
     * Test converting model to HTTP request
     *
     * @covers \calderawp\interop\Models\Model::toResponse()
     * @covers \calderawp\interop\Http\Response::getBody()
     *
     * @group http
     * @group model
     */
    public function testToResponse()
    {
        $array = ['foo' => 'roy', 'id' => 42 ];
        $entity = \calderawp\interop\Mock\Entity::fromArray( $array );
        $model = new \calderawp\interop\Mock\Model( $entity );
        $this->assertEquals( 'roy', $model->getEntity()->foo );
        $body = \GuzzleHttp\json_decode( $model->toResponse()->getBody()->getContents() );
        $this->assertSame( $array, (array) $body );
    }

    /**
     * Test converting model to HTTP request and back to array
     *
     * @covers \calderawp\interop\Models\Model::toResponse()
     * @covers \calderawp\interop\Http\Response::getBody()
     *
     * @group http
     * @group model
     */
    public function testToResponseToArray()
    {
        $array = ['foo' => 'roy', 'id' => 42 ];
        $entity = \calderawp\interop\Mock\Entity::fromArray( $array );
        $model = new \calderawp\interop\Mock\Model( $entity );
        $this->assertEquals( 'roy', $model->getEntity()->foo );
        $body = \GuzzleHttp\json_decode( $model->toResponse()->getBody()->getContents() );
        $this->assertSame( $array, \calderawp\interop\Mock\Entity::fromArray( (array) $body )->toArray() );
    }

}