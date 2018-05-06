# Service Providers
These providers do NOT represent entities, collections or models.

All providers MUST implement `calderawp\interop\Interfaces\ProvidesService`

## Creating A Service Provider
Provider classes MUST have:
* A `registerService` service.
    * This method is passed the main container and used to bind services.
    * Is passed an instance of `calderawp\CalderaContainers\Interfaces\ServiceContainer` to bind services to.
    * Normally this container is the [caldera-containers ServiceContainer](https://github.com/CalderaWP/caldera-containers/blob/master/README.MD#calderawpcalderacontainersservicecontainer).
* A `getAlias` method
    * This method defines the alias used to resolve from container.
    * Alias SHOULD be set in a class constant.
    
### 

#### Alias
```php
    const ALIAS = 'myService';
    public function getAlias()
    {
        return self::ALIAS;
    }

```

#### Binding Services
##### Register Singleton
Bind a lazy-loaded singleton to container. Each request for service returns the same object.
* See: https://github.com/CalderaWP/caldera-containers/blob/master/README.MD#binding-a-lazy-loaded-singleton
```php
    public function registerService(ServiceContainer $container)
    {
        $container->singleton($this->getAlias(), function () use ($container) {
            return new YourClass();
        });
    }

``` 
##### Register Factory
Bind a factory, so each request for service creates and returns a new object.

* See: https://github.com/CalderaWP/caldera-containers/blob/master/README.MD#binding-as-factory
```php
    public function registerService(ServiceContainer $container)
    {
        $container->bind($this->getAlias(), function () use ($container) {
            return new YourClass();
        });
    }

``` 

* A function called 
## Available Services

### Submission
Create and track entries

* $app should be `\calderawp\interop\CalderaForms`
* $form should be `\calderawp\interop\Models\Form`

```php
    use \calderawp\interop\CalderaForms;
    use \calderawp\interop\Providers\SubmissionsProvider;
    use \calderawp\interop\Submissions\Submission;
    $app = CalderaForms::factory();
    
    //$app should be `\calderawp\interop\CalderaForms`
    //Get service from container
    $collection = $app
        ->getService( SubmissionsProvider::ALIAS );
    
    //Start a new submission and capture its ID in $id
    $id = $collection->startNew( $_POST, $form );
    
    //Get the submission from the container
    /** @var Submission $submission */
    $submission = $app
        ->getService( SubmissionsProvider::ALIAS )
        ->get( $id );
    
    //Update  a field value
    $submission->setFieldValue(
            //Field ID
            'fld123',
            //New Value
            'Hi Roy'
    );
    
    //Get entry field value by ID
    $emailFieldValue = $submission
        //Get entry field value entity
        ->getFieldValue( 'fld1234' )
        //Get actual entry field value
        ->getValue();
    
    //Get entry field value by Slug
    $emailFieldValue = $submission
        //Get entry field value entity
        ->getFieldValue( 'email' )
        //Get actual entry field value
        ->getValue();
```