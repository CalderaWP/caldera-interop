<?php


namespace calderawp\interop;


use calderawp\interop\Interfaces\Factory;
use calderawp\interop\Interfaces\Service;

abstract class Container implements \JsonSerializable
{

	/**
	 * @var  array
	 */
	protected $defaults;

	/**
	 * @var array
	 */
	protected $attributes;

	/**
	 * @var \Pimple\Container
	 */
	protected $pimple;

	public function __construct( array $attributes = array(), array  $defaults = array() )
	{
		$this->setProps( $attributes, $defaults);
		$this->pimple = new \Pimple\Container();
	}

    /**
     * Register a service in the container
     *
     * @param Service $service
     */
    public function registerService( Service $service )
    {

    }

    /**
     * Register a factory in the container
     *
     * @param Factory $factory
     */
    public function registerFactory( Factory $factory )
    {
        $factories = $this->getFactories();
        $factories[ $factory->getType() ] = $factory;
        $this->set( 'factories', $factories );
    }

    protected function getFactories()
    {
        return is_array( $this->get( 'factories' ) )
            ? $this->get( 'factories' )
            : [];
    }


	public function get( $property )
	{
		if( $this->allowed( $property ) ){
			if ( $this->pimple->offsetExists( $property )) {
				return $this->pimple->offsetGet($property);
			}elseif( array_key_exists( $property, $this->defaults ) ){
				return $this->defaults[ $property ];
			}else{
				return null;
			}
		}

		return null;
	}

	public function set( $property, $value )
	{
		if( $this->pimple->offsetExists( $property ) ){
			$this->pimple->offsetSet( $property, $value );
		}

		return $this;


	}

	/**
	 * @param $property
	 * @return bool
	 */
	public function allowed( $property )
	{
		return ( array_key_exists( $property, $this->attributes ) && $this->pimple->offsetExists( $property ) );
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		$data = array();
		foreach ( $this->attributes as $property ){
			$data[ $property ] = $this->get( $property );
		}

		return $data;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}

	/**
	 * @param array $attributes
	 * @param array $defaults
	 */
	private function setProps(array $attributes, array $defaults)
	{
		$this->attributes = $attributes;
		$this->defaults = $defaults;
		$this->propArrayMerge('attributes', $attributes);
		$this->propArrayMerge('defaults', $defaults);
	}

	/**
	 * @param $prop
	 * @param array $new
	 */
	private function propArrayMerge( $prop, array  $new = array() ){
		if( ! empty( $new ) ){
			$this->$prop = array_merge( $new, $this->$prop );
		}
	}

}