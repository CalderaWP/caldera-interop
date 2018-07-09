<?php
namespace calderawp\interop\Tests;


use calderawp\CalderaContainers\Service\Container;
use calderawp\interop\ArrayLike\Form;
use calderawp\interop\CalderaForms;
use calderawp\interop\CalderaForms\Form\FormEntity as FormEntity;
use calderawp\interop\Collection;

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
        $this->assertTrue($entity->hasProp('name'));
        $this->assertSame($id, $entity->getName());
    }
    /**
     * Test that the default value for fields property is returned, using getter function
     *
     * @covers FormEntity::getFields()
     */
    public function testGetFieldsDefault()
    {
        $id = 'cf121';
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
        $this->assertTrue( $entity->hasProp('name'));
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
        $id = 'cf1211';
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
        $id = 'cf122';
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
        $id = 'cf123';
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
        $id = 'cf124';
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
        $id = 'cf125';
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
        $id = 'cf126';
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

    /**
     * Testing adding forms to collection
     *
     * @covers \calderawp\interop\Collection::addEntity()
     * @covers \calderawp\interop\CalderaForms::getFormsCollection()
     * @covers \calderawp\interop\CalderaForms::setupServiceContainer()
     */
    public function testAddToCollection(){
        $id = 'cf1';
        $entity = $this->formEntityFactory($id);
        $calderaForms = $this->calderaFormsFactory();
        $this->assertSame(Collection::class, get_class($calderaForms->getFormsCollection() ) );
        $this->assertSame(Collection::class, get_class($calderaForms->getFormsCollection() ) );
        $calderaForms->getFormsCollection()->addEntity($this->formEntityFactory());
        $calderaForms->getFormsCollection()->addEntity($entity);
        $calderaForms->getFormsCollection()->addEntity($this->formEntityFactory());
        $this->assertEquals($entity, $calderaForms->getFormsCollection()->get($id));
    }

    /**
     *
     * @covers \calderawp\interop\Entity::hasProp()
     * @covers \calderawp\interop\Entity::hasPropDefinition()
     */
    public function testHasPropForAttributeProp(){
        $entity = $this->formEntityFactory();
        $this->assertTrue($entity->hasProp('processors' ) );
    }

    /**
     *
     * @covers \calderawp\interop\Entity::getProp()
     * @covers \calderawp\interop\Entity::hasProp()
     * @covers \calderawp\interop\Entity::hasPropDefinition()
     */
    public function testGetPropForAttributePropDefault(){
        $entity = $this->formEntityFactory();
        $this->assertSame([], $entity->getProp('processors' ) );
    }

    /**
     *
     * @covers \calderawp\interop\Entity::getProp()
     * @covers \calderawp\interop\Entity::hasProp()
     * @covers \calderawp\interop\Entity::hasPropDefinition()
     */
    public function testSetPropForAttributeProp(){
        $entity = $this->formEntityFactory();
        $processors = [
            'ID' => '1'
        ];
        $entity->setProp( 'processors', $processors);
        $this->assertEquals($processors,$entity->getProp('processors' ) );
    }

    /**
     *
     * @covers \calderawp\interop\Model::fromEntity()
     * @covers \calderawp\interop\Model::getEntity()
     */
    public function testCreateModelFromEntity(){
        $entity = $this->formEntityFactory();
        $processors = [
            'ID' => '1'
        ];
        $entity->setProp( 'processors', $processors);
        $model  = CalderaForms\Form\FormModel::fromEntity($entity,$this->calderaFormsFactory());
        $this->assertEquals($entity, $model->getEntity() );
    }

    /**
     *
     * @covers \calderawp\interop\Model::__consturct()
     * @covers \calderawp\interop\Model::getEntity()
     */
    public function testCreateModelFromEntityThroughConstructor(){
        $entity = $this->formEntityFactory();
        $processors = [
            'ID' => '1'
        ];
        $entity->setProp( 'processors', $processors);
        $model  = new CalderaForms\Form\FormModel($entity,$this->calderaFormsFactory());
        $this->assertEquals($entity, $model->getEntity() );
    }

    /**
     *
     * @covers \calderawp\interop\Model::getStatusCode()
     */
    public function testModelStatusCode(){
        $entity = $this->formEntityFactory();
        $model = new CalderaForms\Form\FormModel($entity,$this->calderaFormsFactory());
        $model->setStatusCode(500);
        $this->assertSame(500, $model->getStatusCode());

    }

    /**
     *
     * @covers \calderawp\interop\Model::isValid()
     */
    public function testModelIsValidByDefault(){
        $entity = $this->formEntityFactory();
        $model = new CalderaForms\Form\FormModel($entity,$this->calderaFormsFactory());
        $this->assertTrue($model->isValid());

    }
    /**
     *
     * @covers \calderawp\interop\Model::isValid()
     */
    public function testModelIsValidWith200Code(){
        $entity = $this->formEntityFactory();
        $model = new CalderaForms\Form\FormModel($entity,$this->calderaFormsFactory());
        $model->setStatusCode(201);
        $this->assertTrue($model->isValid());

    }
    /**
     *
     * @covers \calderawp\interop\Model::isValid()
     */
    public function testModelIsNotValidWith500Code(){
        $entity = $this->formEntityFactory();
        $model = new CalderaForms\Form\FormModel($entity,$this->calderaFormsFactory());
        $model->setStatusCode(503);
        $this->assertFalse($model->isValid());
    }


    /**
     * @covers \calderawp\interop\Model::setType()
     * @covers \calderawp\interop\Model::getTyoe()
     */
    public function testSetType(){
        $collection  = new Collection();
        $collection->setType( 'foo' );
        $this->assertSame('foo', $collection->getType() );
    }


}