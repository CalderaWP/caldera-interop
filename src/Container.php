<?php


namespace calderawp\interop;



use function calderawp\interop\Support\value;
use Psr\Container\ContainerInterface;

abstract class Container implements \JsonSerializable, ContainerInterface
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

	/** @inheritdoc */
	public function get($id )
	{
		if( $this->allowed( $id ) ){
			if ( $this->pimple->offsetExists( $id )) {
				return $this->pimple->offsetGet($id);
			}elseif( array_key_exists( $id, $this->defaults ) ){
				return $this->defaults[ $id ];
			}else{
				return null;
			}
		}

		return null;
	}

    /**
     * @param string $id
     * @param mixed $value
     * @return $this
     */
	public function set( $id, $value )
	{
		if( $this->allowed( $id ) ){
			$this->pimple->offsetSet( $id, $value );
		}

		return $this;


	}

    /** @inheritdoc */
    public function has( $id )
    {
        return  $this->allowed( $id )  && $this->pimple->offsetExists( $id  );

    }

	/**
	 * @param $id
	 * @return bool
	 */
	public function allowed( $id )
	{
        return isset( $id, $this->attributes );
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
		    if( ! empty( $this->$prop ) ){
                $this->$prop = $new;
            }else{
		        var_dump( $this->prop );exit;
                $this->$prop = array_merge( $new, $this->$prop );
            }
		}
	}

}