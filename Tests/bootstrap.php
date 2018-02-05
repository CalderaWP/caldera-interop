<?php
if ( file_exists( dirname( __FILE__, 2  ) . '/vendor/autoload.php' ) ) {

	include_once __DIR__ . '/CalderaInteropTestCase.php';
	include_once __DIR__ . '/ModelCalderaInteropTestCase.php';
	include_once __DIR__ . '/CollectionCalderaInteropTestCase.php';
	include_once __DIR__ . '/EntityCalderaInteropTestCase.php';
	function loader($class)
	{
		$file = $class . '.php';
		if (file_exists($file)) {
			require $file;
		}

		if( \calderawp\interop\Mock\Entity::class === $class ){
		    require __DIR__ . '/Mocks/Entity.php';
        }

        if( \calderawp\interop\Mock\Collection::class === $class ){
            require __DIR__ . '/Mocks/Collection.php';
        }

        if( \calderawp\interop\Mock\Plugin::class === $class ){
            require __DIR__ . '/Mocks/Plugin.php';
        }

        if( \calderawp\interop\Mock\EntityFactoryPlugin::class === $class ){
            require __DIR__ . '/Mocks/EntityFactoryPlugin.php';
        }

        if( \calderawp\interop\Mock\CollectionFactoryPlugin::class === $class ){
            require __DIR__ . '/Mocks/CollectionFactoryPlugin.php';
        }

        if( \calderawp\interop\Mock\App::class === $class ){
            require __DIR__ . '/Mocks/App.php';
        }

        if( \calderawp\interop\Mock\ValidatingEntity::class === $class ){
            require __DIR__ . '/Mocks/ValidatingEntity.php';
        }


        if( \calderawp\interop\Mock\CastingEntity::class === $class ){
            require __DIR__ . '/Mocks/CastingEntity.php';
        }

        if( \calderawp\interop\Mock\EmailCastingEntity::class === $class ){
            require __DIR__ . '/Mocks/EmailCastingEntity.php';
        }



        if( \calderawp\interop\Mock\Container::class === $class ){
            require __DIR__ . '/Mocks/Container.php';
        }



    }

	spl_autoload_register('loader');

	include_once dirname(__FILE__, 2) . '/vendor/autoload.php';
}else{
	throw  new Exception( 'No autoloader' );
}

