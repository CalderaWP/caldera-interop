<?php

/**
 * Class AppTest
 *
 * Test our App works fine
 *
 * @covers \calderawp\interop\App
 * @covers \calderawp\interop\InteropApp
 */
class AppTest extends CalderaInteropTestCase
{

    /**
     * Test adding plugins directly to service container
     *
     * @covers \calderawp\interop\App::addPlugin()
     */
    public function testAddPlugin()
    {
        $app = $this->appFactory();

        $plugin = new \calderawp\interop\Mock\Plugin();

        $app->addPlugin( $plugin );

        $this->assertSame(
            'Entities.Entry.Details',
            $app->getServiceContainer()->getIndustry()->getServiceMap()->typeToId(
                \calderawp\interop\Entities\Entry\Details::class
            )
        );

        $this->assertInstanceOf(
            \calderawp\interop\Mock\Entity::class,
                $app->getServiceContainer()->getIndustry()->createEntity( \calderawp\interop\Entities\Entry\Details::class,
                    [
                        [
                            'ID' => uniqid( 'CF' )
                        ]

                    ]
                )

        );


        $this->assertInstanceOf(
            \calderawp\interop\Entities\Entry\Field::class,
            $app->getServiceContainer()->getIndustry()->createEntity( \calderawp\interop\Entities\Entry\Field::class,
                [
                    [
                        'ID' => uniqid( 'CF' )
                    ]

                ]
            )

        );

    }

    /**
     * Test adding plugins using the 'calderaInterop.plugins.load' filter
     *
     * @covers \calderawp\interop\App::loadPlugins()
     * @covers \calderawp\interop\App::addPlugin()
     */
    public function testAddPluginViaEvent()
    {
        $app = $this->appFactory();

        $plugin = new \calderawp\interop\Mock\Plugin();

        $filter = \calderawp\interop\Events\Event::fromArray(
            [
                'name' => 'calderaInterop.plugins.load',
                'callback' => function( $plugins ) use ( $plugin ) {

                    $plugins[] = $plugin;
                    return $plugins;
                },

            ]
        );

        $app->getServiceContainer()
            ->getEventsManager()
            ->addFilter(
                $filter
        );

        $app->loadPlugins();

        $this->assertSame(
            'Entities.Entry.Details',
            $app->getServiceContainer()->getIndustry()->getServiceMap()->typeToId(
                \calderawp\interop\Entities\Entry\Details::class
            )
        );

        $this->assertInstanceOf(
            \calderawp\interop\Mock\Entity::class,
            $app->getServiceContainer()->getIndustry()->createEntity( \calderawp\interop\Entities\Entry\Details::class,
                [
                    [
                        'ID' => uniqid( 'CF' )
                    ]

                ]
            )

        );


        $this->assertInstanceOf(
            \calderawp\interop\Entities\Entry\Field::class,
            $app->getServiceContainer()->getIndustry()->createEntity( \calderawp\interop\Entities\Entry\Field::class,
                [
                    [
                        'ID' => uniqid( 'CF' )
                    ]

                ]
            )

        );

    }

    /**
     * Test adding plugins directly to service container of InteropApp
     *
     * @covers \calderawp\interop\InteropApp::addPlugin()
     */
    public function testAddPluginToInteropApp()
    {
        $app = $this->appFactory();
        $plugin = new \calderawp\interop\Mock\Plugin();

        $app->addPlugin( $plugin );

        $this->assertSame(
            'Entities.Entry.Details',
            $app->getServiceContainer()->getIndustry()->getServiceMap()->typeToId(
                \calderawp\interop\Entities\Entry\Details::class
            )
        );

        $this->assertInstanceOf(
            \calderawp\interop\Mock\Entity::class,
            $app->getServiceContainer()->getIndustry()->createEntity( \calderawp\interop\Entities\Entry\Details::class,
                [
                    [
                        'ID' => uniqid( 'CF' )
                    ]

                ]
            )

        );


        $this->assertInstanceOf(
            \calderawp\interop\Entities\Entry\Field::class,
            $app->getServiceContainer()->getIndustry()->createEntity( \calderawp\interop\Entities\Entry\Field::class,
                [
                    [
                        'ID' => uniqid( 'CF' )
                    ]

                ]
            )

        );

    }

    /**
     * Test adding plugins using the 'calderaInterop.plugins.load' filter to InteropApp
     *
     * @covers \calderawp\interop\InteropApp::loadPlugins()
     * @covers \calderawp\interop\InteropApp::addPlugin()
     */
    public function testAddPluginViaEventToInteropApp()
    {
        $app = $this->appFactory();

        $plugin = new \calderawp\interop\Mock\Plugin();

        $filter = \calderawp\interop\Events\Event::fromArray(
            [
                'name' => 'calderaInterop.plugins.load',
                'callback' => function( $plugins ) use ( $plugin ) {

                    $plugins[] = $plugin;
                    return $plugins;
                },

            ]
        );

        $app->getServiceContainer()
            ->getEventsManager()
            ->addFilter(
                $filter
            );

        $app->loadPlugins();

        $this->assertSame(
            'Entities.Entry.Details',
            $app->getServiceContainer()->getIndustry()->getServiceMap()->typeToId(
                \calderawp\interop\Entities\Entry\Details::class
            )
        );

        $this->assertInstanceOf(
            \calderawp\interop\Mock\Entity::class,
            $app->getServiceContainer()->getIndustry()->createEntity( \calderawp\interop\Entities\Entry\Details::class,
                [
                    [
                        'ID' => uniqid( 'CF' )
                    ]

                ]
            )

        );


        $this->assertInstanceOf(
            \calderawp\interop\Entities\Entry\Field::class,
            $app->getServiceContainer()->getIndustry()->createEntity( \calderawp\interop\Entities\Entry\Field::class,
                [
                    [
                        'ID' => uniqid( 'CF' )
                    ]

                ]
            )

        );

    }

    /**
     * Test registering plugin in app
     *
     * @covers \calderawp\interop\App::addPlugin()
     */
    public function testEntityOvveridePlugin()
    {

        $app = $this->appFactory();

        $plugin = new \calderawp\interop\Mock\FactoryPlugin();
        $app->addPlugin( $plugin );
        $this->assertInstanceOf(
            \stdClass::class,
            $app->getServiceContainer()
                ->getIndustry()
                ->createEntity( 'Entities.Foo.Entity', [] )
        );
    }

    /**
     * Test creating Entity from main app
     *
     * @covers \calderawp\interop\App::createEntity()
     */
    public function testCreateEntity()
    {
        $app = $this->appFactory();

        $expectedEntity = $this->entityFactory( 'FIELD' );

        $this->assertSame(
            get_class( $expectedEntity ),
            get_class(
                $app->createEntity(
                \calderawp\interop\Entities\Field::class,
                [
                    $this->fieldArrayFactory( rand() )
                ]
            ))

        );

        $industry = $this->industryFactory();

        $this->assertSame(
            get_class(
                $industry->createEntity(
                    \calderawp\interop\Entities\Field::class,
                    [
                        $this->fieldArrayFactory( rand() )
                    ]
                )
            ),
            get_class(
                $app->createEntity(
                    \calderawp\interop\Entities\Field::class,
                    [
                        $this->fieldArrayFactory( rand() )
                    ]
                )
            )

        );






    }

    /**
     * Test creating collection from main app
     *
     * @covers \calderawp\interop\App::createCollection()
     */
    public function testCreateCollection()
    {
        $app = $this->appFactory();
        $industry = $this->industryFactory();

        $this->assertTrue(
            is_object(
                $app->createCollection( \calderawp\interop\Collections\EntityCollections\Fields::class )
            )
        );

        $this->assertSame(
            get_class(
                $industry->createCollection(\calderawp\interop\Collections\EntityCollections\Fields::class )
            ),
            get_class(
                $app->createCollection( \calderawp\interop\Collections\EntityCollections\Fields::class )
            )
        );

    }



}