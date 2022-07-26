<?php

use WebTheory\WpCliUtil\WpCliUtil;

use function Env\env;

/**
 *==========================================================================
 * WordPress Base Config
 *==========================================================================
 *
 * @link https://developer.wordpress.org/apis/wp-config-php/
 *
 * Because WordPress allows wp-config.php to be located in a directory above the
 * web root, we're able to place it in the root directory of, and load WordPress
 * from our project. This and several other files required only for development
 * will be excluded anytime we create an archive or release.
 *
 * We'll kick things off by bootstrapping our development environment and robust
 * suite of debugging tools.
 *
 */
call_user_func(function () {
    require_once __DIR__ . '/boot/development/runtime.php';
});

/**
 *==========================================================================
 * Database
 *==========================================================================
 *
 * Here we define database constants using corresponding environment variables.
 *
 */
define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASSWORD', env('DB_PASSWORD'));
define('DB_HOST', env('DB_HOST'));
define('DB_CHARSET', env('DB_CHARSET') ?? 'utf8');
define('DB_COLLATE', env('DB_COLLATE') ?? '');

$table_prefix = env('DB_PREFIX') ?? 'wp_';

/**
 *==========================================================================
 * Urls
 *==========================================================================
 *
 * Set the url values of the homepage and wp-admin; also from corresponding
 * environment variables.
 *
 */
define('WP_HOME', env('WP_HOME'));
define('WP_SITEURL', env('WP_SITEURL') ?? WP_HOME);

/**
 *==========================================================================
 * Directories
 *==========================================================================
 *
 * Specify key WordPress directories.
 *
 * Below we set the uploads directory as a subdirectory of the project to
 * simplify inclusion in revision. This works because the entire project is
 * symlinked into the theme directory.
 *
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/' . WpCliUtil::getInstallPath() . '/');
}

/**
 *==========================================================================
 * Happy Editing 🍻
 *==========================================================================
 *
 * Finally, we bootstrap WordPress and we're all set!
 *
 */
require_once ABSPATH . 'wp-settings.php';
