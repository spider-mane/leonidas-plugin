<?php

use function PseudoVendor\PseudoPlugin\plugin_header;

return [

    /**
     *==========================================================================
     * Plugin Name
     *==========================================================================
     *
     * The name of your plugin, stylized to your liking.
     */
    'name' => plugin_header('name'),

    /**
     *==========================================================================
     * Version
     *==========================================================================
     *
     * Current version of your plugin.
     */
    'version' => plugin_header('version'),

    /**
     *==========================================================================
     * Description
     *==========================================================================
     *
     * Description of your plugin that an about page can display. Can be
     * different from (and more descriptive than) the one in the plugin header.
     */
    'description' => plugin_header('description'),

    /**
     *==========================================================================
     * Slug (Textdomain)
     *==========================================================================
     *
     * The plugin slug should ideally be identical to your plugin package name.
     * A slug is essentially a human-readable identifier and it is one way that
     * your plugin will be identified and referenced within WordPress including
     * but not limited to resolving the textdomain.
     *
     * @link https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#text-domains
     */
    'slug' => plugin_header('textdomain'),

    /**
     *==========================================================================
     * Namespace
     *==========================================================================
     *
     * A key to to use in contexts where it's desirable for a value to be
     * namespaced. The extension class will use this to prefix hook names.
     *
     */
    'namespace' => ':plugin_namespace',

    /**
     *==========================================================================
     * Prefix
     *==========================================================================
     *
     * An abbreviated tag that you can use to prefix entries into the system
     * where naming collisions are a highly probable, such as database entries,
     * element ids, input names, etc.
     */
    'prefix' => ':plugin_prefix',

    /**
     *==========================================================================
     * Development
     *==========================================================================
     *
     * A simple expression such as a single function call or ternary statement
     * that should return true if the plugin is in a development environment.
     */
    'dev' => defined('PSEUDO_CONSTANT_DEVELOPMENT'),

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

        PseudoVendor\PseudoPlugin\Modules\AdminAssets::class,

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
     *
     */
    'providers' => [

        # Leonidas
        Leonidas\Framework\Provider\League\AdminNoticeRepositoryServiceProvider::class,
        Leonidas\Framework\Provider\League\GuzzleServerRequestServiceProvider::class,
        Leonidas\Framework\Provider\League\TransientsChannelServiceProvider::class,
        Leonidas\Framework\Provider\League\TwigFlexViewServiceProvider::class,

        # Plugin

    ],

    /**
     *==========================================================================
     * Bootstrap
     *==========================================================================
     *
     * Bootstrap assistants are classes you can use to encapsulate your
     * bootstrap requirements. Useful for keeping your Launcher class
     * simple and being able to reuse bootstrap processes between extensions.
     */
    'bootstrap' => [

        Leonidas\Framework\Bootstrap\BindContainerToFacades::class,
        PseudoVendor\PseudoPlugin\Bootstrap\RegisterModelServices::class,

    ],

    /**
     *==========================================================================
     * Facades
     *==========================================================================
     *
     * If using facades, this points the bootstrap process to the base facade so
     * that it can bind it to your container.
     *
     */
    'facade' => PseudoVendor\PseudoPlugin\Access\_Facade::class,

];
