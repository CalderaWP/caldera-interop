<?php
namespace calderawp\interop\Tests;


use calderawp\interop\CalderaForms\Form\Entity as FormEntity;
class FormTest extends CalderaInteropTestCase
{

    /**
     * Test that the default value for name is returned, using getter function
     *
     * @covers FormEntity::getName()
     */
    public function testGetNameDefault()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $this->assertSame($id, $entity->getName());
    }
    /**
     * Test that the default value for fields property is returned, using getter function
     *
     * @covers FormEntity::getFields()
     */
    public function testGetFieldsDefault()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $this->assertSame([], $entity->getFields());
    }
    /**
     * Test the getter and setter together for the name property
     *
     * @covers FormEntity::setName()
     * @covers FormEntity::getName()
     * @covers FormEntity::$name
     */
    public function testSetName()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $entity->setName('Hi Roy' );
        $this->assertSame('Hi Roy', $entity->getName());
    }
    /**
     * Test the getter and setter together for the fields property
     *
     * @covers FormEntity::getFields()
     * @covers FormEntity::setFields()
     * @covers FormEntity::$fields
     */
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

    /**
     * Test that the default value for name is returned, using the magic accessor
     *
     * @covers FormEntity::$name
     * @covers \calderawp\interop\Entity::getterName()
     * @covers \calderawp\interop\Entity::applyGetter()
     */
    public function testGetNameDefaultProp()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $this->assertSame($id, $entity->name);
    }
    /**
     * Test that the default value for fields property is returned, using the magic accessor
     *
     * @covers FormEntity::getFields()
     * @covers \calderawp\interop\Entity::getterName()
     * @covers \calderawp\interop\Entity::applyGetter()
     */
    public function testGetFieldsDefaultProp()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $this->assertSame([], $entity->fields);
    }
    /**
     * Test the getter and setter together for the name property, using the magic accessor and setter
     *
     * @covers FormEntity::getName()
     * @covers FormEntity::setName()
     * @covers \calderawp\interop\Entity::getterName()
     * @covers \calderawp\interop\Entity::applyGetter()
     * @covers \calderawp\interop\Entity::getterName()
     * @covers \calderawp\interop\Entity::applyGetter()
     */
    public function testSetNameProps()
    {
        $id = 'cf12';
        $entity = $this->formEntityFactory($id);
        $entity->name = 'Hi Roy';
        $this->assertSame('Hi Roy', $entity->name);
    }
    /**
     * Test the getter and setter together for the fields property
     *
     * @covers FormEntity::getFields()
     * @covers FormEntity::setFields()
     * @covers \calderawp\interop\Entity::getterName()
     * @covers \calderawp\interop\Entity::applyGetter()
     * @covers \calderawp\interop\Entity::getterName()
     * @covers \calderawp\interop\Entity::applyGetter()
     */
    public function testSetFieldsProp()
    {
        $id = 'cf12';
        $fields = [
            [
                'ID'=> 'fld12345'
            ]
        ];
        $entity = $this->formEntityFactory($id);
        $entity->fields = $fields;
        $this->assertSame($fields, $entity->fields);
    }

    /**
     * Test converting to array, the fields property
     *
     * @covers FormEntity::$fields
     * @covers FormEntity::getFields()
     * @covers \calderawp\interop\Entity::applyGetter()
     * @covers \calderawp\interop\Entity::toArray()
     */
    public function testToArray(){
        $id = 'cf11';
        $entity = $this->formEntityFactory($id);
        $asArray = $entity->toArray();
        $this->assertArrayHasKey('fields', $asArray );
        $this->assertSame( $entity->getFields(), $asArray['fields'] );
    }

    /**
     * Test if it knows if it has a getter function
     * @covers \calderawp\interop\Entity::hasGetter()
     */
    public function testHasGetter()
    {
        $entity = $this->formEntityFactory();
        $this->assertTrue($entity->hasGetter('name' ) );
        $this->assertFalse($entity->hasGetter('roy' ) );
    }

    /**
     * Test if it knows it has a setter function
     *
     * @covers \calderawp\interop\Entity::hasSetter()
     */
    public function testHasSetter()
    {
        $entity = $this->formEntityFactory();
        $this->assertTrue($entity->hasSetter('name' ) );
        $this->assertFalse($entity->hasSetter('roy' ) );
    }

    /**
     * Test that all getters are used when casting to array
     *
     * @covers \calderawp\interop\Entity::toArray()
     * @covers \calderawp\interop\Entity::hasGetter()
     */
    public function testAllToArray(){
        $entity = $this->formEntityFactory();
        $asArray = $entity->toArray();
        foreach ( $entity->getEntityProps() as $prop ){
            if( $entity->hasGetter( $prop ) ){
                $ufProp = ucfirst($prop);
                $getter = "get{$ufProp}";
                $this->assertSame( $entity->$getter() , $asArray[$prop] );
            }

        }
    }


}