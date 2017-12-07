<?php


namespace calderawp\interop;



use calderawp\interop\Collections\Collection;
use calderawp\interop\Collections\EntityCollections\Fields;
use calderawp\interop\Entities\Entity;
use calderawp\interop\Entities\Entry;
use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Exceptions\Exception;
use calderawp\interop\Entities\Field;
use calderawp\interop\Entities\Form;
use calderawp\interop\Support\Arr;
use Psr\Container\ContainerInterface;


/**
 * Class ServiceMap
 *
 * Maps continent dot references to the type of object you'd want in current context.
 *
 * By default, the type \calderawp\interop\Entities\Entry::class would return a \calderawp\interop\Entities\Entry object, but a framework-specific subclass might be provided.
 *
 * @package calderawp\interop
 */
class ServiceMap implements ContainerInterface
{

    /**
     * Map of services
     *
     * @var array
     */
    private $map;

    /**
     * Array of namespaces that we map objects to
     *
     * @var array
     */
    private $namespaces = [
        "calderawp\\interop\\",
    ];

    /**
     * Add a namespace and map its object types
     *
     * @param string $namespace New namespace to map
     * @param array $map Array with keys (or dot keys) matching $this->map() to override the object type in map
     *
     * @return $this
     */
    public function registerNamespace( $namespace, array  $map )
    {
        array_unshift( $this->namespaces, $namespace );
        foreach ( $map as $type => $class ){
            $map = $this->getMap();
            Arr::forget( $map, $type );
            Arr::set( $map, $type, $class );
            $this->map = $map;
        }


        return $this;
    }

    /**
     * Get an entity reference
     *
     * @param $type
     *
     * @return Entity
     * @throws ContainerException
     */
    public function getEntity( $type )
    {

        $id = $this->typeToId( $type );

        if( null === $id || 0 !== strpos( $id, 'Entities' ) ){
            throw new ContainerException( sprintf( 'Not Entity. Type called: %s', $type ) );
        }

        if( $this->has( $id ) ){
            return $this->get( $id );


        }

        throw new ContainerException( sprintf( 'Entity not found. Type called: %s', $type ) );

    }

    /**
     * Get a collection
     *
     * @param string $type
     * @return Collection
     *
     * @throws ContainerException
     */
    public function getCollection($type )
    {
        $id = $this->typeToId( $type );

        if( null === $id || 0 !== strpos( $id, 'Collections' ) ){
            throw new ContainerException( );
        }

        if( $this->has( $id ) ){
            return $this->get( $id );

        }

        throw new ContainerException();

    }

    /**
     * Get reference to object used in current context by type
     *
     * NOTE: Generally, $this->getEntity() or $this->getType() should be used instead of this
     *
     * @param string $type Name of base interop object
     *
     * @return Collection|Entity
     * @throws Exception
     */
    public function getByType( $type )
    {
        $id = $this->typeToId( $type );
        if( $id ){
            try{
                return $this->get( $id );
            }catch ( Exception $e ){
                throw $e;
            }
        }
    }

    /**
     * Convert a type to the $id param for $this->get() or $this->set()
     *
     * @param string $type
     * @return string|null
     */
    public function typeToId( $type )
    {
        foreach ( $this->namespaces as $namespace ){
            $id = '';
            if( 0 === strpos( $type, $namespace ) ) {
                $id = str_replace( $namespace, '', $type);
                $id = str_replace('\\', '.', $id);


                if ( $this->has( $id ) ) {
                    return $id;
                }

            }

        }

        return null;

    }

    /**
     * Check if identifier is in the map
     *
     * @param string $id
     * @return bool
     */
    public function has( $id ){
        $id = $this->idShortHandFix( $id );
        if( Arr::has( $this->getMap(), $id ) ){
            return true;
        }

        return false;
    }

    /**
     * Get by identifier
     *
     * @param string $id
     * @return Collection|Entity
     * @throws ContainerException
     */
    public function get( $id )
    {
        $id = $this->idShortHandFix( $id );
        if( $this->has( $id ) ){
            return Arr::get( $this->getMap(), $id );
        }

        throw new ContainerException( $id );
    }

    /**
     *  Get the array mapping services
     *
     * @return array
     */
    public function getMap()
    {
        if( ! $this->map ){
            $this->setMap();
        }
        return $this->map;
    }

    /**
     * Sets the map property
     */
    protected function setMap()
    {
        $this->map =  [
            'Entities' => [
                'Entry' => [
                    'Entity'    => Entry::class,
                    'Details'   => Entry\Details::class,
                    'Field'     => Entry\Field::class,
                ],
                'Field' => [
                    'Entity' => Field::class
                ],
                'Form' => [
                    'Entity' => Form::class
                ]
            ],
            'Collections' => [
                'EntityCollections' => [
                    'Fields' => Fields::class,
                    'EntryValues' => [
                        'Fields' => \calderawp\interop\Collections\EntityCollections\EntryValues\Fields::class

                    ]
                ]
            ]
        ];
    }

    /**
     * If id is shorthand style, adjust back to full dot notation
     *
     * @param $id
     * @return string
     */
    protected function idShortHandFix( $id )
    {
        if( 'Entities' !== $id && 0 === strpos( $id, 'Entities' ) ){

            $type = str_replace( 'Entities.', '', $id );
            $map = $this->getMap();
            if( array_key_exists( $type, $map[ 'Entities' ] ) ){
                $id .= '.Entity';
            }

        }

        return $id;
    }
}