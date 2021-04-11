<?php

/**
 * This file is part of the :plugin_name WordPress plugin.
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 *
 * @package :vendor_name/:plugin_slug
 * @version :plugin_version
 * @license MIT
 * @copyright Copyright (C) :system_year, :plugin_author, All rights reserved.
 * @link :plugin_website
 * @author :plugin_author <:author_email>
 *
 * @wordpress-plugin
 * Plugin Name: :plugin_name
 * Plugin URI: :plugin_website
 * Description: :plugin_description
 * Version: :plugin_version
 * Requires at least: 5.0
 * Requires PHP: 7.3
 * Author: :plugin_author
 * Author URI: :author_website
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: :plugin_slug
 * Domain Path: /languages
 */

use Leonidas\Framework\Helpers\Plugin;
use PseudoVendor\PseudoPlugin\Launcher;

defined('ABSPATH') || exit;

$init = static function () {
    require __DIR__ . '/boot/init.php';

    Launcher::init(
        Plugin::base(__FILE__),
        Plugin::path(__FILE__),
        Plugin::url(__FILE__)
    );
};

if (did_action('leonidas_init')) {
    $init();
} else {
    add_action('leonidas_init', $init);
}
