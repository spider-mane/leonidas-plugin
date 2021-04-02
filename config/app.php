<?php

use WebTheory\Config\ConfigReflector;

return [

    /**
     *==========================================================================
     * Modules
     *==========================================================================
     *
     * Modules are classes that hook into WordPress and initiate desired
     * functionality for the specific events. Because all modules are passed
     * your WpExtensionInterface instance, which in turn provides access to your
     * DI container, they can be designed in a way makes them portable and
     * reusable between projects.
     */
    'modules' => [
        PseudoVendor\PseudoPlugin\Setup::class
    ],

    /**
     *==========================================================================
     * Services
     *==========================================================================
     *
     * Services are pre-configured objects made available throughout your
     * application via a dependency injection container. You can define
     * individual services here in a manner that allows you to populate your
     * container by iterating over them. Doing this cleanly from this context
     * requires use of a container with introspection capabilities or a
     * StaticProviderInterface, which is a simple static, library-independent
     * service provider which contains the actual instantiation logic as well as
     * a ConfigReflectorInterface instance which allows for providing the a set
     * of options from the same configuration repository. Besides "id",
     * "provider", and "args", the exact key=>value structure will depend on
     * your container library of choice.
     */
    'services' => [
        [
            'id' => Leonidas\Library\Admin\Loaders\AdminNoticeCollectionLoaderInterface::class,
            'provider' => Leonidas\Framework\Providers\AdminNoticeCollectionLoaderProvider::class,
            'args' => ConfigReflector::map([
                'prefix' => 'plugin.prefix.extended'
            ]),
            'shared' => true,
            'tags' => ['admin_notice_loader']
        ]
    ],

    /**
     *==========================================================================
     * Providers
     *==========================================================================
     *
     * Some DI containers support "service providers." These are typically self
     * contained classes with all the logic required for inserting an entry into
     * a container according to that container's capabilities. Because all
     * necessary logic is encapsulated within them, library-specific providers
     * are the cleanest solution to building your container.
     */
    'providers' => [],

    /**
     *==========================================================================
     * Bootstrap
     *==========================================================================
     *
     * Bootstrap assistants are classes you can use to encapsulate your
     * bootstrap requirements. Useful for keeping your Launcher class
     * simple and being able to reuse bootstrap processes between extensions.
     */
    'bootstrap' => [],
];
