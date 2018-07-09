<?php


namespace calderawp\interop\Tests;


use calderawp\interop\CalderaForms\Entry\EntryEntity;
use calderawp\interop\CalderaForms\Entry\EntryFieldEntity;
use calderawp\interop\CalderaForms\Entry\EntryMetaEntity;
use calderawp\interop\CalderaForms\Form\FieldEntity;
use calderawp\interop\CalderaForms\Form\FormEntity;
use calderawp\interop\CalderaForms\Processors\ProcessorTypeEntity;
use calderawp\interop\CalderaForms\Settings\GeneralSettingsEntity;
use calderawp\interop\Collection;

class CalderaFormsTest extends CalderaInteropTestCase
{

    /**
     * @covers \calderawp\interop\CalderaForms::setupServiceContainer()
     * @covers \calderawp\interop\CalderaForms::getFormsCollection()
     */
    public function testGetFormsCollection()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertEquals(FormEntity::class, $calderaForms->getFormsCollection()->getType());
    }

    /**
     * @covers \calderawp\interop\CalderaForms::collectionFactory()
     */
    public function testCollectionFactory()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertEquals(FormEntity::class, $calderaForms->collectionFactory([], FormEntity::class)->getType());

    }


    /**
     * @covers \calderawp\interop\CalderaForms::addForm()
     * @covers \calderawp\interop\CalderaForms::getForm()
     */
    public function testGetForm()
    {
        $form = $this->formEntityFactory();
        $calderaForms = $this->calderaFormsFactory();
        $calderaForms
            ->addForm($form);
        $this->assertEquals($form, $calderaForms
            ->getForm($form->getId()));
    }

    /**
     * Test getting general settings from main container
     *
     * @covers \calderawp\interop\CalderaForms::getGeneralSettings()
     */
    public function testGetGeneralSettings()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertSame(GeneralSettingsEntity::class,
            get_class($calderaForms->getGeneralSettings()));

    }

    /**
     * Test getting new Entry from main container
     *
     * @covers \calderawp\interop\CalderaForms::newEntry()
     */
    public function testGetNewEntry()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertSame(EntryEntity::class,
            get_class($calderaForms->newEntry()));

    }

    /**
     * Test getting  new entry field from main container
     *
     * @covers \calderawp\interop\CalderaForms::newEntryField()
     */
    public function testGetNewEntryField()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertSame(EntryFieldEntity::class,
            get_class($calderaForms->newEntryField()));

    }

    /**
     * Test getting  new entry meta field from main container
     *
     * @covers \calderawp\interop\CalderaForms::newEntryMetaField()
     */
    public function testGetNewEntryMetaField()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertSame(EntryMetaEntity::class,
            get_class($calderaForms->newEntryMetaField()));

    }
    /**
     * Test getting  processors collection from the main container
     *
     * @covers \calderawp\interop\CalderaForms::getProcessorTypesCollection()
     */
    public function testGetProcessorsCollection()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertSame(Collection::class,
            get_class($calderaForms->getProcessorTypesCollection()));
    }
}