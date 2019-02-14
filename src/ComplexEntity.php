<?php


namespace calderawp\interop;
use calderawp\caldera\Messaging\Traits\SimpleRepository;
use calderawp\caldera\restApi\Response;
use calderawp\interop\Collections\Attributes;
use calderawp\interop\Contracts\Arrayable;
use calderawp\interop\Contracts\ConvertsToResponse;
use calderawp\interop\Contracts\Rest\RestResponseContract;
use calderawp\interop\Contracts\HasAttributes;
use calderawp\interop\Traits\ProvidesAttributes;


class ComplexEntity implements Arrayable
{
	use ProvidesAttributes,SimpleRepository;

	/**
	 * Add attribute definition
	 *
	 * @param Attribute $attribute
	 *
	 * @return ComplexEntity
	 */
	public function addAttribute(Attribute $attribute ): ComplexEntity
	{
		$this->attributesCollection = $this->getAttributes()->addAttribute($attribute);
		return $this;
	}
	/** @inheritdoc */
	public function getAllowedProperties(): array
	{
		$attributeCollection = ! empty($this->attributesCollection) ? $this->attributesCollection : new Attributes();
		if( $attributeCollection->empty()){
			return [];
		}
		$allowed = [];
		foreach ( $attributeCollection->toArray() as $item ){
			$allowed[] = $item['name'];
		}
		return $allowed;
	}

	/**
	 * Create REST response from entity
	 *
	 * @param int $status
	 * @param array $headers
	 *
	 * @return RestResponseContract
	 */
	public function toRestResponse(int$status = 200, array $headers = []): RestResponseContract
	{
		return (new Response())->setData($this->toArray())->setStatus($status)->setHeaders($headers);
	}

	/**
	 * Create entity from REST response
	 *
	 * @param RestResponseContract $response
	 *
	 * @return ComplexEntity
	 */
	public static function fromRestResponse( RestResponseContract $response ) : ComplexEntity
	{
		return static::fromArray($response->getData());
	}


	/**
	 * Create from array
	 *
	 * @param array $items
	 *
	 * @return ComplexEntity
	 */
	public static function fromArray( array $items = []) : ComplexEntity
	{
		$obj = new static();
		foreach ( $obj->getAllowedProperties() as $prop ){
			if( isset( $items[$prop ]) ){
				$obj->$prop = $items[$prop ];
			}
		}
		return $obj;
	}

	/** @inheritdoc */
	public function jsonSerialize()
	{
		return $this->toArray();
	}


	public function get($name, $default = null)
	{
		if( $this->allowed($name)&& $this->has($name)){
			return $this->attributes[$name];
		}
	}

	public function set(string $name, $value)
	{
		if( $this->allowed($name)){
			 $this->attributes[$name] = $value;
			 return $this;
		}
		throw new Exception('Invalid attribute');

	}

}
