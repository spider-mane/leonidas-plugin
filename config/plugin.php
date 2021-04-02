<?php

return [

    /**
     *==========================================================================
     * Plugin Name
     *==========================================================================
     *
     * The name of your plugin, stylized to your liking.
     */
    'name' => ':plugin_name',

    /**
     *==========================================================================
     * Version
     *==========================================================================
     *
     * Current version of your plugin.
     */
    'version' => ':plugin_version',

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
     * Slug (Textdomain)
     *==========================================================================
     *
     * The plugin slug should ideally be identical to your plugin package name.
     * A slug is essentially a human-readable identifier and the primary way
     * that your plugin will be identified and referenced within WordPress. By
     * WordPress standards, this must also be your plugin textdomain.
     *
     * @link https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#text-domains
     */
    'slug' => ':plugin_slug',

    /**
     *==========================================================================
     * Description
     *==========================================================================
     *
     * Description of your plugin that an about page can display. Can be
     * different from (and more descriptive than) the one in the plugin header.
     */
    'description' => ':plugin_description',

    /**
     *==========================================================================
     * Assets
     *==========================================================================
     *
     * The directory, relative to the root directory where plugin assets are
     * located.
     */
    'assets' => 'assets/dist/',

    /**
     *==========================================================================
     * Dependencies
     *==========================================================================
     *
     * A list of plugins that your own plugin depends on to properly function.
     * Use the textdomain/slug of any such plugin.
     */
    'dependencies' => [
        'leonidas',
    ],

    /**
     *==========================================================================
     * Development
     *==========================================================================
     *
     * A simple expression, ideally a single function call or tertiary statement
     * that should return true if the plugin is in a development environment.
     */
    'dev' => defined('PSEUDO_CONSTANT_DEVELOPMENT'),
];
