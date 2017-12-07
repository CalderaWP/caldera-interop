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
        $app = new \calderawp\interop\Mock\App(
            new \calderawp\interop\ServiceContainer(),
            dirname( __FILE__ ),
            '0.1.1'
        );

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
        $app = new \calderawp\interop\Mock\App(
            new \calderawp\interop\ServiceContainer(),
            dirname( __FILE__ ),
            '0.1.1'
        );

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
        $app = new \calderawp\interop\InteropApp(
            new \calderawp\interop\ServiceContainer(),
            dirname( __FILE__ ),
            '0.1.1'
        );

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
        $app = new \calderawp\interop\InteropApp(
            new \calderawp\interop\ServiceContainer(),
            dirname( __FILE__ ),
            '0.1.1'
        );

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

        $app = new \calderawp\interop\InteropApp(
            new \calderawp\interop\ServiceContainer(),
            dirname( __FILE__ ),
            '0.1.1'
        );

        $plugin = new \calderawp\interop\Mock\FactoryPlugin();
        $app->addPlugin( $plugin );
        $this->assertInstanceOf(
            \stdClass::class,
            $app->getServiceContainer()
                ->getIndustry()
                ->createEntity( 'Entities.Field', [] )
        );
    }

}