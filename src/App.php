<?php


namespace calderawp\interop;


use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Interfaces\Plugin;
use calderawp\interop\Interfaces\PluginOrApp;

abstract class App implements \calderawp\interop\Interfaces\App
{

    /**
     * @var \Pimple\Container
     */
    private $container;

    /**
     * @var ServiceContainer
     */
    private $serviceContainer;

    /**
     * @var string
     */
    private $basePath;
    /**
     * @var string
     */
    private $version;

    public function __construct(ServiceContainer $serviceContainer, $basePath, $version )
    {
        $this->container = new \Pimple\Container();
        $this->serviceContainer = $serviceContainer;
        $this->basePath = $basePath;
        $this->version = $version;

    }

    /**
     *  Get basePath property
     *
     * @return string
     */
    public function basePath()
    {
        return $this->basePath;

    }

    /**
     * Adds plugins at the calderaInterop.plugins.load event
     */
    public function loadPlugins(){

        $plugins = [];
        $plugins = $this->getServiceContainer()
            ->getEventsManager()
            ->applyFilters(
                'calderaInterop.plugins.load',
                $plugins,
                [$this]
        );

        if( ! empty( $plugins ) ){
            foreach ( $plugins as $plugin ){
                $this->addPlugin( $plugin );
            }
        }

        $this->getServiceContainer()
            ->getEventsManager()
            ->doAction(
                'calderaInterop.plugins.loaded',
                [ $this ]
            );
    }
    /**
     * Register a plugin with App
     *
     * @param Plugin $plugin
     * @return $this
     */
    public function addPlugin( Plugin $plugin )
    {
        if( ! $this->has( 'PLUGINS' ) ){
            $plugins = [];
        }else{
            $plugins = $this->get( 'PLUGINS' );
        }

        $this->mapServices( $plugin );
        $plugins[ $plugin->getNamespace() ] = $plugin;
        $this->container->offsetSet( 'PLUGINS', $plugins );
        $plugin->pluginLoaded( $this->getEventsManager() );
        return $this;

    }

    /**
     * Map a plugin's service
     *
     * @param Plugin $plugin
     */
    protected function mapServices( Plugin $plugin )
    {
        $this->getServiceContainer()
            ->getServiceMap()
            ->registerNamespace(
                $plugin->getNamespace(),
                $plugin->getOverrideMap()
            );
    }

    /**
     * Get version property
     *
     * @return string
     */
    public function version()
    {
        return $this->version;
    }

    /** @inheritdoc */
    public function get($id)
    {
        if( 'INDUSTRY'  === strtoupper( $id ) ){
            return $this->getServiceContainer()->getIndustry();
        }elseif ( 'SERVICEMAP' === strtoupper( $id ) ){
            return $this->getServiceContainer()->getServiceMap();
        }elseif( $this->has( $id ) ) {
            return $this->container->offsetGet($id);
        } else{
            throw new ContainerException();
        }

    }

    /** @inheritdoc */
    public function has($id)
    {
        return $this->container->offsetExists($id);
    }

    /**
     * @return ServiceContainer
     */
    public function getServiceContainer()
    {
        return $this->serviceContainer;
    }

    /**
     * @return Events\Events
     */
    public function getEventsManager()
    {
        return $this->getServiceContainer()->getEventsManager();
    }
}