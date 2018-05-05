<?php


namespace calderawp\interop\Entities;

class Field extends Entity
{

	/**
	 * @var array
	 */
	protected $field;

	/**
	 * Field constructor.
	 *
	 * @param array $field
	 */
	public function __construct(array  $field = [])
	{
		$id = isset($field[ 'ID' ]) ? $field[ 'ID' ] : '';
		$this->setId($id);
		$this->field = $field;
	}

	/**
	 * Get field.config
	 *
	 * @return array
	 */
	public function getConfigKey()
	{
		return $this->fieldKey('config', []);
	}

	/**
	 * Get default value for field
	 *
	 * @return mixed|null
	 */
	public function getDefault()
	{
		return $this->configKey('default', '');
	}

	/**
	 * Get field.config.$key
	 *
	 * @param string $key
	 * @param null|mixed $default Optional. Default value
	 * @return mixed|null
	 */
	public function configKey($key, $default = null)
	{
		$config = $this->getConfigKey();
		return array_key_exists($key, $config)
			? $config[ $key ]
			: $default;
	}

	/**
	 * Get field field.slug
	 *
	 * @return string
	 */
	public function getSlug()
	{
		return $this->fieldKey('slug', '');
	}

	public function setSlug($newSlug)
	{
		$this->field[ 'slug' ] = $newSlug;
		return $this;
	}

	/**
	 * Get field.$key
	 *
	 * @param  string     $key     Key to get
	 * @param  null|mixed $default Optional default value
	 * @return mixed|null
	 */
	public function fieldKey($key, $default = null)
	{
		return isset($this->field[ $key ]) ? $this->field[ $key ] : $default ;
	}


	/**
	 * @inheritdoc
	 */
	public function setId($id)
	{
		//$this->setId($id);
		parent::setId($id);
	}

	/**
	 * @inheritdoc
	 */
	public function toArray()
	{
		return $this->field;
	}

	/** @inheritdoc */
	public static function getType()
	{
		return 'field';
	}
}
