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
     * @covers \calderawp\interop\CalderaFormsInterop::setupServiceContainer()
     * @covers \calderawp\interop\CalderaFormsInterop::getFormsCollection()
     */
    public function testGetFormsCollection()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertEquals(FormEntity::class, $calderaForms->getFormsCollection()->getType());
    }

    /**
     * @covers \calderawp\interop\CalderaFormsInterop::collectionFactory()
     */
    public function testCollectionFactory()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertEquals(FormEntity::class, $calderaForms->collectionFactory([], FormEntity::class)->getType());

    }


    /**
     * @covers \calderawp\interop\CalderaFormsInterop::addForm()
     * @covers \calderawp\interop\CalderaFormsInterop::getForm()
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
     * @covers \calderawp\interop\CalderaFormsInterop::getGeneralSettings()
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
     * @covers \calderawp\interop\CalderaFormsInterop::newEntry()
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
     * @covers \calderawp\interop\CalderaFormsInterop::newEntryField()
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
     * @covers \calderawp\interop\CalderaFormsInterop::newEntryMetaField()
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
     * @covers \calderawp\interop\CalderaFormsInterop::getProcessorTypesCollection()
     */
    public function testGetProcessorsCollection()
    {
        $calderaForms = $this->calderaFormsFactory();
        $this->assertSame(Collection::class,
            get_class($calderaForms->getProcessorTypesCollection()));
    }
}