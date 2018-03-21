<?php


namespace calderawp\interop;


use calderawp\interop\Interfaces\ProvidesService;

class ServiceContainer
{

    /**
     * @var ProvidesService[]
     */
    protected $services;


    public function doesProvide( $serviceName ){
        return array_key_exists( $serviceName, $this->services );
    }

    /**
     * Bind a service to the container.
     *
     * @param $alias
     * @param $concrete
     * @return mixed
     */
    public function bind($alias, $concrete)
    {
        $this->services[$alias] = $concrete;
    }

    /**
     * Request a service from the container.
     *
     * @param $alias
     * @return mixed
     */
    public function make($alias)
    {
        if (isset($this->services[$alias]) and is_callable($this->services[$alias])) {
            return call_user_func_array($this->services[$alias], array($this));
        }

        if (isset($this->services[$alias]) and is_object($this->services[$alias])) {
            return $this->services[$alias];
        }

        if (isset($this->services[$alias]) and class_exists($this->services[$alias])) {
            return $this->resolve($this->services[$alias]);
        }

        return $this->resolve($alias);
    }

    /**
     * Bind a singleton instance to the container.
     *
     * @param $alias
     * @param $binding
     */
    public function singleton($alias, $binding)
    {
        $this->bind($alias, $this->make($binding));
    }


    private function resolve($class)
    {
        $reflection = new \ReflectionClass($class);

        $constructor = $reflection->getConstructor();

        // Constructor is null
        if ( ! $constructor) {
            return new $class;
        }

        // Constructor with no parameters
        $params = $constructor->getParameters();

        if (count($params) === 0) {
            return new $class;
        }

        $newInstanceParams = array();

        foreach ($params as $param) {
            // @todo Here we should probably perform a bunch of checks, such as:
            // isArray(), isCallable(), isDefaultValueAvailable()
            // isOptional() etc.

            if (is_null($param->getClass())) {
                $newInstanceParams[] = null;
                continue;
            }

            $newInstanceParams[] = $this->make(
                $param->getClass()->getName()
            );
        }

        return $reflection->newInstanceArgs(
            $newInstanceParams
        );
    }

}