<?php

use WebTheory\Config\Deferred\Reflection;

use function PseudoVendor\PseudoPlugin\abspath;

return [

    'root' => abspath(),

    'paths' => [

        'views',

    ],

    'options' => [

        'autoescape' => false,

        'cache' => abspath('/storage/cache/views/twig'),

        'debug' => Reflection::get('app.dev'),

    ],

    'extensions' => [

        # Leonidas
        Leonidas\Library\Core\View\Twig\AdminFunctionsExtension::class,
        Leonidas\Library\Core\View\Twig\PrettyDebugExtension::class,
        Leonidas\Library\Core\View\Twig\SkyHooksExtension::class,
        Leonidas\Library\Core\View\Twig\StringHelperExtension::class,

        # Plugin
        PseudoVendor\PseudoPlugin\TwigExtension::class,

        # Third-Party

    ],
];
