<?php


class FormModelEvents extends ModelCalderaInteropTestCase
{

    /**
     * @var bool
     */
    protected $eventDispatched;


    /**
     * Test we can use pre-dispatch hook on requests properly
     *
     * @covers Form::fromRequest()
     */
    public function testPreDispatchRequestHook()
    {

        $this->eventDispatched = false;
        $formId = uniqid('CF');
        $request = new \GuzzleHttp\Psr7\Request(
            'GET',
            "forms/$formId"
        );

        $entity = new \calderawp\interop\Entities\Form();
        $entity->setId($formId);

        $filter = [
            'name' => 'form.model.preDispatchRequest',
            'callback' => function ($value, $args) use ($request, $formId, $entity) {
                $this->eventDispatched = true;

                $this->assertNull($value);
                $this->assertTrue(is_array($args));
                $this->assertSame($request, $args[0]);

                $this->assertSame($formId, $entity->getId());
                $model = new \calderawp\interop\Models\Form($entity);
                $model->setId($formId);
                $this->assertSame($entity->getId(), $model->getId());
                return $model;

            },
            'args' => 1,
            'priority' => 10
        ];

        $event = \calderawp\interop\Events\Event::fromArray($filter);

        \calderawp\interop\Interop()
            ->getEventsManager()
            ->addFilter($event);


        $model = \calderawp\interop\Models\Form::fromRequest($request);

        $this->assertTrue($this->eventDispatched);
        $this->assertSame($formId, $model->getId());
        $this->assertSame($entity, $model->getEntity());

    }


    /**
     *
     * @covers Form::toResponse()
     */
    public function testPreDispatchResponseHook()
    {
        $this->eventDispatched = false;
        $formId = uniqid('CF');
        $entity = new \calderawp\interop\Entities\Form();
        $entity->setId($formId);
        $model = new \calderawp\interop\Models\Form($entity);
        $model->setId($formId);


        $filter = [
            'name' => 'form.model.preDispatchResponse',
            'callback' => function (\Psr\Http\Message\ResponseInterface $response, $args) use ($formId, $entity,$model) {
                $this->eventDispatched = true;
                $this->assertNotEmpty($args[0]);
                $this->assertSame($args[0],$model);
                return $response->withHeader('X-HI', 'Roy' );

            },
            'args' => 1,
            'priority' => 10
        ];

        $event = \calderawp\interop\Events\Event::fromArray($filter);
        \calderawp\interop\Interop()
            ->getEventsManager()
            ->addFilter($event);

        $response = $model->toResponse();
        $this->assertTrue($this->eventDispatched);
        $this->assertTrue($response->hasHeader('X-HI'));
        $this->assertEquals('Roy', $response->getHeader('X-HI'));

    }
}