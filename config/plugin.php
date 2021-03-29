<?php

return [

    'name' => ':plugin_name',

    'version' => ':plugin_version',

    'prefix' => ':plugin_prefix',

    'slug' => ':package_name',

    'description' => ':plugin_description',

    'assets' => 'assets/dist/',

    'dependencies' => [],

    'dev' => defined('PSEUDO_CONSTANT_DEVELOPMENT'),
];
