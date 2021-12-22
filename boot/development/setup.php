<?php

use Dotenv\Dotenv;
use WebTheory\Config\Config;
use WebTheory\Exterminate\Exterminator;

$root = dirname(__DIR__, 2);

require_once "$root/vendor/autoload.php";

/**
 * Capture environment variables from .env file
 */
Dotenv::createUnsafeImmutable($root)->load();

/**
 * Capture development configuration
 */
$config = new Config("$root/config/development");

/**
 * Establish that plugin is in a development environment
 */
define('PSEUDO_CONSTANT_DEVELOPMENT', true);

/**
 * Initiate debug support
 */
Exterminator::init($config->get('debug'));

/**
 * Return development configuration
 */
return $config;
