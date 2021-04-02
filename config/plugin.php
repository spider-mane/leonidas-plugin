<?php

return [

    'name' => ':plugin_name',

    'version' => ':plugin_version',

    'prefix' => ':plugin_prefix',

    'slug' => ':plugin_slug',

    'description' => ':plugin_description',

    'assets' => 'assets/dist/',

    'dependencies' => [],

    'dev' => defined('PSEUDO_CONSTANT_DEVELOPMENT'),
];
