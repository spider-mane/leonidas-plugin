<?php

defined('ABSPATH') || exit;

$root = dirname(__FILE__, 2);

require __DIR__ . '/functions.php';
require __DIR__ . '/constants.php';

// composer autoload
if (file_exists($autoload = $root . '/vendor/autoload.php')) {
    require $autoload;
}
