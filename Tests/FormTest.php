<?php
namespace calderawp\interop\Tests;


use calderawp\interop\CalderaForms\Form\Entity as FormEntity;
class FormTest extends CalderaInteropTestCase
{

    public function testTests()
    {
        $this->assertTrue(true);
    }

    public function testGetNameDefault()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $this->assertSame($id, $entity->getName());
    }

    public function testGetFieldsDefault()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $this->assertSame([], $entity->getFields());
    }

    public function testSetName()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $entity->setName('Hi Roy' );
        $this->assertSame('Hi Roy', $entity->getName());
    }

    public function testSetFields()
    {
        $id = 'cf12';
        $fields = [
            [
                'ID'=> 'fld12345'
            ]
        ];
        $entity = $this->formEntityFactory($id);
        $entity->setFields($fields);
        $this->assertSame($fields, $entity->getFields());

    }


}