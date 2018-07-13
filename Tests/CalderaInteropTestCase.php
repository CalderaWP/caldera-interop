<?php
namespace calderawp\interop\Tests;
use calderawp\CalderaContainers\Service\Container;
use calderawp\interop\CalderaFormsInterop;
use calderawp\interop\CalderaForms\Form\FormEntity as FormEntity;

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
     * @return CalderaFormsInterop
     */
    protected function calderaFormsFactory(){
        return new CalderaFormsInterop( new Container() );
    }

}