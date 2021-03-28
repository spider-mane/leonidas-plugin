<?php

/**
 * This file is part of the :vendor_name :plugin_name package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package :plugin_name
 * @license MIT
 * @copyright Copyright (C) :plugin_author, All rights reserved.
 * @link :plugin_url
 * @author :plugin_author <:author_email>
 *
 * @wordpress-plugin
 * Plugin Name: :plugin_name
 * Description: :plugin_description
 */

use Leonidas\Framework\Helpers\Plugin;
use PseudoVendor\PseudoNamespace\PseudoPlugin;

defined('ABSPATH') || exit;

require __DIR__ . '/boot/init.php';

PseudoPlugin::init(
    Plugin::base(__FILE__),
    Plugin::path(__DIR__),
    Plugin::url(__DIR__),
);
