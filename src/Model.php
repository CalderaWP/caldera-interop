<?php


namespace calderawp\interop;

use calderawp\interop\Contracts\CalderaFormsInteropComponent;
use calderawp\interop\Contracts\CalderaFormsInteroperableComponent;
use calderawp\interop\Contracts\InteroperableEntity;
use calderawp\interop\Contracts\InteroperableModel;
use calderawp\interop\Http\Response;
use calderawp\interop\Traits\CanCastObjectToArray;
use calderawp\interop\Traits\CanRecursivelyCastArray;
use Psr\Http\Message\RequestInterface;

abstract class Model implements InteroperableModel
{

	protected $statusCode;
	use CanCastObjectToArray,CanRecursivelyCastArray;
	/**
	 * @var InteroperableEntity
	 */
	protected $entity;

	/**
	 * @var CalderaFormsInterop
	 */
	protected $calderaForms;

	/**
	 * Model constructor.
	 * @param InteroperableEntity $entity
	 * @param CalderaFormsInteroperableComponent $calderaForms
	 */
	public function __construct(InteroperableEntity $entity, CalderaFormsInteroperableComponent $calderaForms)
	{
		$this->entity = $entity;
		$this->calderaForms = $calderaForms;
	}

	/** @inheritdoc */
	public static function fromEntity(InteroperableEntity $entity, CalderaFormsInteroperableComponent $calderaForms)
	{
		return new static($entity, $calderaForms);
	}

	/** @inheritdoc */
	public function getEntity()
	{
		return $this->entity;
	}

	/** @inheritdoc */
	public function toArray()
	{
		return $this->getEntity()->toArray();
	}

	/**@inheritdoc */
	public function getCalderaForms()
	{
		return $this->calderaForms;
	}


	/** @inheritdoc */
	public static function fromRequest(RequestInterface $request)
	{
		$request->getBody()->rewind();
		$body = $request->getBody()->getContents();
		if (is_object($decoded = json_decode($body))) {
			$body = static::arrayCastRecursiveStatic($decoded);
		}

		return static::fromArray($body);
	}

	/** @inheritdoc */
	public function isValid()
	{
		if (! is_numeric($this->statusCode)) {
			return true;
		}
		return  0 === strpos((string) $this->getStatusCode(), '2');
	}

	/** @inheritdoc */
	public function setStatusCode($statusCode = 200)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/** @inheritdoc */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/** @inheritdoc */
	public function jsonSerialize()
	{
		return $this->getEntity()->toArray();
	}

	/** @inheritdoc */
	public function toResponse(array $headers = [])
	{
		return new Response(json_encode($this), $this->statusCode, $headers);
	}
}
