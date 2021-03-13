<?php

/**
 * This file is part of the :vendor_name :package_name package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package :plugin_name
 * @license :license
 * @copyright Copyright (C) :package_author, All rights reserved.
 * @link :package_url
 * @author :package_author <:author_email>
 *
 * @wordpress-plugin
 * Plugin Name: :plugin_name
 * Description: :description
 */

use Noodlehaus\ConfigInterface;
use Psr\Container\ContainerInterface;
use WebTheory\Leonidas\Enum\ExtensionType;
use WebTheory\Leonidas\Framework\ModuleInitializer;
use WebTheory\Leonidas\Framework\WpExtension;

// composer autoload
if (file_exists($autoload = __DIR__ . '/vendor/autoload.php')) {
    require $autoload;
}

// required during development only
if (file_exists($development = __DIR__ . '/boot/development.php')) {
    require $development;
}

/** @var ContainerInterface $container */
$container = require __DIR__ . '/boot/container.php';

/** @var ConfigInterface $config */
$config = $container->get('config');

$base = WpExtension::create([
    'name' => $config->get('plugin.name'),
    'prefix' => $config->get('plugin.prefix'),
    'description' => $config->get('plugin.description'),
    'base' => plugin_basename(__FILE__),
    'path' => __DIR__,
    'uri' => plugin_dir_url(__FILE__),
    'assets' => $config->get('plugin.assets'),
    'type' => new ExtensionType('plugin'),
    'container' => $container,
    'dev' => ':plugin_name_uc_DEVELOPMENT',
]);

$plugin = new ModuleInitializer($base, $base->config('app.modules'));

$plugin->init();
