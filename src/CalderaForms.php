<?php


namespace calderawp\interop;
use calderawp\CalderaContainers\Interfaces\ServiceContainer;
use League\Fractal;


/**
 * Class CalderaForms
 *
 * The "app" that epsulates Caldera Forms interop features
 *
 * @package calderawp\interop
 */
class CalderaForms extends \calderawp\CalderaContainers\Container {

    const TRANSFORMER = 'TRANSFORMER';
    const COLLECTION = 'COLLECTION';
    /**
     * @var \calderawp\CalderaContainers\Service\Container
     */
    private $serviceContainer;
    public function __construct(ServiceContainer $serviceContainer )
    {
        $this->serviceContainer = $serviceContainer;
    }

    public function fractal(

    ){
        $this->serviceContainer->bind(self::COLLECTION, function(){
           return new Collection();
        });

        $this->serviceContainer->singleton(FormEntity::class, $this->collectionFactory() );
    }

    /**
     * @return Fractal\Resource\Collection
     */
    public function getFormsCollection(){
        return $this->serviceContainer->make(FormEntity::class);

    }

    public function collectionFactory(array $data = []){
       return new Fractal\Resource\Collection(new Collection($data), $this->make(self::TRANSFORMER ) );

    }
}
