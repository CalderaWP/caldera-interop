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
    public function __construct( array  $field )
    {
        $this->setId($field[ 'ID' ]);
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
     * Get field field.slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->fieldKey('slug', '');

    }

    /**
     * Get field.$key
     *
     * @param  string     $key     Key to get
     * @param  null|mixed $default Optional default value
     * @return mixed|null
     */
    public function fieldKey( $key, $default = null )
    {
        return isset($this->field[ $key ]) ? $this->field[ $key ] : $default ;
    }


    /**
     * @inheritdoc 
     */
    public function setId( $id )
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




}