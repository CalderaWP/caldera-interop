<?php
namespace calderawp\interop\Tests;
use calderawp\CalderaContainers\Service\Container;
use calderawp\interop\CalderaForms;
use calderawp\interop\CalderaForms\Form\Entity as FormEntity;

abstract class CalderaInteropTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @param string $id
     * @return FormEntity
     */
    protected function formEntityFactory($id = ''){
        if( ! $id ){
            $id = uniqid( 'cf' );
        }

        return (new FormEntity() )->setId($id );
    }

    /**
     * @return CalderaForms
     */
    protected function calderaFormsFactory(){
        return new CalderaForms( new Container() );
    }

}