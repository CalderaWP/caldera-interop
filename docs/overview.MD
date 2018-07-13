
## Why?
The architectural challenge that caldera-interop address is that its very hard to keep different types of data constiently typed, structured, sanitized, validated, etc. This gets especially challenging when data is represented in different languages, which in our case is primarily PHP, JavaScript, MySQL and using different frameworks, which in our case is primarily WordPress, Laravel, React + Redux, etc.

The lowest unit of architecture is the Entity, a logicless object-representation of a data type. The `InteroperableEntity` interface is used for these entities. As a result, they MUST be creatable from a plain array and convert to a plain array and serialize to JSON, so that the result of deserializing that array can create a functionally identical entity.

The next level is the Model. Models decorate Entities and add logic. They implement the `InteroperableModel` interface and can convert to and from HTTP requests (represented as objects implementing the PSR-7 standard) and have a standard API for database interactions that can be implemented in a specific framework, out of scope of this code base.

The highest level unit of this architecture is an object of a class implementing the interface `calderawp\interop\CalderaInteroperableComponent`, which we can call a "component". Components are containers. They contain a `calderawp\CalderaContainers\Interfaces\ServiceContainer` instance. This container MUST be the only place that Interoperable Entities and Models are instantiated.

By doing so, the source of state in the application is totally black boxed. The source of the data can be a database, a remote API, mock test data, it does not matter.


A component can contain zero or more components. Components may be contained by zero or more components. `CalderaFormsInteroperableComponent` is an interface extending the base component that provides `InteroperableEntities` and `InteroperableModels`. This code is adapted from the WordPress plugin Caldera Forms' version 1 code base. This will allow us to have a defined schema for Caldera Forms forms and entry data that will have the same API as new data types.
 
The  `CalderaFormsInteroperableComponent` reference implementation is `CalderaFormsInterop`, which will be implimented in the WordPress plugin Caldera Forms (2.0) and the web app Caldera Forms Pro. Some of this architecture is already in use in Caldera Forms Pro microservices. IT is designed to pair well with the caldera-js set of npm modules.

A "Caldera Forms" uses a `CalderaFormsInteroperableComponent` and a `CalderaFormsUiComponent`. For `CalderaFormsUiComponent` the interface is defined in this library. Concrete implementation is out of scope.

There are also collections. Collections extend [Doctrine's Collection class](https://www.doctrine-project.org/projects/doctrine-collections/en/latest/index.html)