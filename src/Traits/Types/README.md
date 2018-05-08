# Type Traits
Type traits are used to create a single source of truth for the string identifier for an interoperable set.

In general this type is provided by providing an implementation of the `Interoperable` interface's `getType()` method, which is static and the `InteroperableEntity`'s `getTheType()` method which is not static. Both methods MUST return the same value. This value MUST be used as the alias when binding the interoperable set to the interoperable service container/ factory.

Since `getType()` is static, you can use the type trait directly to use the alias.

```php

$entity = $app->getFactory()->entity( MyTypeTrait::getType() );
```

The [example integration repo documents](https://github.com/CalderaWP/caldera-interop-extension-example/blob/master/DOCS.md) an interoperable set that uses a [Type trait](https://github.com/CalderaWP/caldera-interop-extension-example/blob/master/src/Traits/HelloType.php).


## Types
__Note__: Trait types are still being introduced. They simplify existing systems already in place.

### Type Naming Conventions


#### Class Names
Classes should be named `$setType`. For example, the `Processor` entity uses the `ProcessorType` trait.
#### String Identifiers
* All Caldera Forms types should begin with `cf.`.
* Core features will be `cf.core.$feature`
* Add-ons will use `cf.core.$feature`
* Pro will use `cf.pro.$feature`
* Other compatible applications may establish their own root.



*These are conventions not rules, for now.* 

### Audible Types
* Processor Type `Processor` - Used for processor entity/ models/ collections.
- `cf.core.processor`
