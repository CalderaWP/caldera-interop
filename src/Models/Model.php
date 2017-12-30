<?php

namespace calderawp\interop\Models;



use calderawp\interop\Container;
use calderawp\interop\Entities\Entity;
use calderawp\interop\Interfaces\EntitySpecific;
use calderawp\interop\Interfaces\Interoperable;
use function calderawp\interop\Interop;
use calderawp\interop\Traits\CanRecursivelyCastArray;
use calderawp\interop\Traits\HasId;
use NetRivet\WordPress\Http\Response;
use Psr\Http\Message\RequestInterface as Request;

abstract class Model implements Interoperable, EntitySpecific
{

	use HasId, CanRecursivelyCastArray;

	/**
	 * @var Entity
	 */
	protected $entity;

    /**
     * @var bool
     */
	protected $valid;

	/**
	 * Model constructor.
	 * @param Entity $entity
	 */
	public function __construct( Entity $entity = null )
	{
		$this->entity = $entity;

	}

	/** @inheritdoc */
	public function isValid()
    {
        return boolval($this->valid);
    }

    /**
	 * @return Entity
	 */
	public function toEntity()
	{
		return $this->entity;
	}

	/**
	 * @param $id
	 */
	public function setId( $id )
	{
		$this->entity->setId( $id );
		$this->id = $id;
	}

	/** @inheritdoc */
	public static function fromRequest(Request $request)
    {
        $pre = Interop()
            ->getEventsManager()
            ->applyFilters(
                static::getType() . '.model.preDispatchRequest', null,[$request]
            );

        if( is_a( $pre, static::class ) ){
            return $pre;
        }
        $body = json_decode($request->getBody()->getContents());
        return self::fromArray($body);
    }


    /** @inheritdoc */
    public function toResponse()
    {
        $response = $pre = Interop()
            ->getEventsManager()
            ->applyFilters(
                static::getType() . '.model.preDispatchResponse', new Response($this->toArray()),[$this]
            );

        return $response;
    }

    /** @inheritdoc */
    public function toArray()
    {
        return $this->entity->toArray();
    }

    /**
     * @return Entity
     */
    public function getEntity(){
        return $this->entity;
    }


    /**
     * Cast from array (or stdClass that can be recursively casted to array)
     *
     * @param array|\stdClass $data
     * @return Entity
     */
    public static function fromArray($data)
    {
        $obj = new static();
        return call_user_func( [$obj->getEntityType(), 'fromArray'],self::arrayCastRecursiveStatic($data));
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getTheType()
    {
        return strtolower(substr(strrchr(get_class($this), '\\'), 1));
    }


}