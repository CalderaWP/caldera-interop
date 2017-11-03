<?php


namespace calderawp\interop\Entities;


class Field extends Entity
{

	protected $field;

	public function __construct( array  $field )
	{
		$this->id = $field[ 'ID' ];
		$this->field = $field;
	}


	/**
	 * @param $id
	 */
	public function setId( $id )
	{
		$this->id = $id;
		parent::setId($id);
	}

	public function toArray()
	{
		return $this->field;
	}

	public function getConfigKey(){
		return isset( $this->field[ 'config' ] ) ? $this->field[ 'config' ] : array();
	}



}