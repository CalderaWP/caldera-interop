# Interop Services
This service container and factory has special bindings for working with one or more "Interoberable Set" -- a related, Interoperable Entity, Model and Collection.

## Usage

Normally the global instance of `\calderawp\interop\CalderaForms` is used. The `getFactory` method exposes the ``calderawp\interop\Service|Container` instance. 

Add an interop set to the container:
```php
$app->getFactory()
	->bindInterop(
	    $identifier,
	    $entityClassName,
	    $modelClassName,
	    $collectionClassName
	)
```

### Container
`calderawp\interop\Service|Container` extends `\calderawp\CalderaContainers\Service\Container` adding no new functionality.
### Factory
`calderawp\interop\Service|Factory` decorates `calderawp\interop\Service|Container` and provides special bindings for Interop models, entities and collections.

#### Examples
* Bind a new set from add-on plugin:
```php
    $app->getFactory()
        ->bindInterop(
            //Unique identifier for this interop set
            $identifier,
            //::class reference for Entity
            \myNamespace\Entities\Thing::class,
            //::class reference for Model
            \myNamespace\Models\Thing::class,
            //::class reference for Collection
            \myNamespace\interop\Collections\Thing::class
        );
```

* Create Empty Field Entity
```php
    use \calderawp\interop\CalderaForms;
    $field = $app
        ->getFactory()
        ->entity( 
            //Identifier for field entity
            CalderaForms::FIELD
        );
```

* Create Field Entity From Array
```php
    use \calderawp\interop\CalderaForms;
    $entity = $app
        ->getFactory()
        ->entity(
                //Identifier for field entity
                CalderaForms::FIELD,
                //Same shape as CF 1 field array
                [
                        'ID' => 'fld1234',
                        'slug' => 'email',
                        'config' => [
                                'default' => 'roy@hiRoy.club'
                        ]
                ]
        );
```

* Create Field Model From Field Entity
```php
    use \calderawp\interop\Entities\Field;
    use \calderawp\interop\CalderaForms;
    /** @var Field $entity */
    $entity = $app
        ->getFactory()
        ->entity(
        //Identifier for field entity
            CalderaForms::FIELD
        );
    //Create model and set entity in it
    $model = $app
       ->getFactory()
       ->model( $entity );

```

* Create Field Collection
```php
    use \calderawp\interop\Entities\Field;
    use \calderawp\interop\CalderaForms;
    //Create empty fields collection
    $fields = $app
        ->getFactory()
        ->collection(
        //Identifier for field
            CalderaForms::FIELD
        );
    
    //Create field entity
    $field = $app
        ->getFactory()
        ->entity(
        //Identifier for field
            CalderaForms::FIELD
        );
    
    //Add field to collection
    $fields->addField( $field );


```