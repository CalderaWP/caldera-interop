<?php


namespace calderawp\interop;

use calderawp\interop\Contracts\Arrayable;

/**
 * Class Attribute
 *
 * Describes a single property of an entity in a way that is Interoperable with database columns and REST API arguments
 */
class Attribute implements Arrayable
{

	/** @var string */
	protected $name;
	/** @var string */
	protected $description;
	/** @var string */
	protected $sqlDescriptor;
	/** @var callable */
	protected $validateCallback;
	/** @var callable */
	protected $sanitizeCallback;
	/** @var string */
	protected $dataType;
	/** @var string */
	protected $format;

	/**
	 * Create item from array
	 *
	 * @param array $items
	 *
	 * @return Attribute
	 */
	public static function fromArray(array $items = []): Attribute
	{
		$obj = new static();

		$obj->setName($items[ 'name' ])
			->setDescription(
				isset($items[ 'description' ]) && is_string($items[ 'description' ]) ? $items[ 'description' ] : ''
			)
			->setSqlDescriptor(isset($items[ 'sqlDescriptor' ]) && is_string($items[ 'sqlDescriptor' ]) ? $items[ 'sqlDescriptor' ] : ''
			)
			->setFormat(
				isset($items[ 'format' ]) && ($items[ 'format' ]) ? $items[ 'format' ] : '%s'
			)
			->setDataType(
				isset($items[ 'dataType' ]) && is_string($items[ 'dataType' ]) ? $items[ 'dataType' ] : 'string'
			);

		if( isset($items[ 'validateCallback' ]) && is_callable($items[ 'validateCallback' ])){
			$obj->setValidateCallback($items[ 'validateCallback' ]);
		}
		if( isset($items[ 'sanitizeCallback' ]) && is_callable($items[ 'sanitizeCallback' ])){
			$obj->setSanitizeCallback($items[ 'sanitizeCallback' ]);
		}

		return $obj;
	}

	protected function validateFormat(?string $format = '%s' ){
		if( !is_string($format)||! in_array( $format, ['%s','%d'])){
			return '%s';
		}
		return$format;
	}

	/** @inheritdoc */
	public function toArray(): array
	{
		return [
			'name' => $this->getName(),
			'description' => $this->getDescription(),
			'sqlDescriptor' => $this->getSqlDescriptor(),
			'validateCallback' => $this->getValidateCallback(),
			'sanitizeCallback' => $this->getSanitizeCallback(),
			'format' => $this->getFormat(),
			'dataType' => $this->getDataType()

		];
	}

	/** @inheritdoc */
	public function jsonSerialize()
	{
		return $this->toArray();
	}

	/**
	 * @return string
	 */
	public function getFormat(): string
	{

		return $this->validateFormat($this->format );
	}

	/**
	 * @param string $format
	 *
	 * @return Attribute
	 */
	public function setFormat(string $format): Attribute
	{
		$this->format = $format;
		return $this;
	}


	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return Attribute
	 */
	public function setName(string $name): Attribute
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return is_string($this->description) ? $this->description : '';
	}

	/**
	 * @param string $description
	 *
	 * @return Attribute
	 */
	public function setDescription(string $description): Attribute
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSqlDescriptor(): string
	{
		return is_string($this->sqlDescriptor) ? $this->sqlDescriptor: '';
	}

	/**
	 * @param string $sqlDescriptor
	 *
	 * @return Attribute
	 */
	public function setSqlDescriptor(string $sqlDescriptor): Attribute
	{
		$this->sqlDescriptor = $sqlDescriptor;
		return $this;
	}


	/**
	 * @return callable|null
	 */
	public function getValidateCallback(): ?callable
	{
		return $this->validateCallback;
	}

	/**
	 * @param callable $validateCallback
	 *
	 * @return Attribute
	 */
	public function setValidateCallback(callable $validateCallback): Attribute
	{
		$this->validateCallback = $validateCallback;
		return $this;
	}

	/**
	 * @return callable|null
	 */
	public function getSanitizeCallback(): ?callable
	{
		return $this->sanitizeCallback;
	}

	/**
	 * @param callable $sanitizeCallback
	 *
	 * @return Attribute
	 */
	public function setSanitizeCallback(callable $sanitizeCallback): Attribute
	{
		$this->sanitizeCallback = $sanitizeCallback;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDataType(): string
	{
		return is_string($this->dataType) ? $this->dataType : 'string';
	}

	/**
	 * @param string $dataType
	 *
	 * @return Attribute
	 */
	public function setDataType(string $dataType): Attribute
	{
		$this->dataType = $dataType;
		return $this;
	}


}
