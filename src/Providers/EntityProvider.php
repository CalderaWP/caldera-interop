<?php


namespace calderawp\interop\Providers;


use calderawp\interop\Entities\Form;
use calderawp\interop\Interfaces\ProvidesService;
use calderawp\interop\ServiceContainer;

class EntityProvider implements ProvidesService
{


    public function registerService(ServiceContainer $serviceContainer)
    {
       $serviceContainer->bind( Form::class, function (){
          return new Form();
       });
    }
}