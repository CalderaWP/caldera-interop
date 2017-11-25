<?php


namespace calderawp\interop;



use calderawp\interop\Collections\Collection;
use calderawp\interop\Collections\EntityCollections\Fields;
use calderawp\interop\Entities\Entity;
use calderawp\interop\Entities\Entry;
use calderawp\interop\Exceptions\ContainerException;
use calderawp\interop\Exceptions\Exception;
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

    public function registerNamespace( $namespace, array  $map )
    {
        array_unshift( $this->namespaces, $namespace );
        foreach ( $map as $type => $class ){
            Arr::set( $this->map, $type, $class );
        }

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
            throw new ContainerException();
        }
        if( $this->has( $id ) ){
            if( 'Entities.Entry' === $id ){
                $id .= '.Entity';
            }
            return $this->get( $id );


        }

        throw new ContainerException();

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
            throw new ContainerException();
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
        return  Arr::has( $this->getMap(), $id );
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
    protected function getMap()
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
}