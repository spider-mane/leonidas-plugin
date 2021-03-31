<?php

defined('ABSPATH') || exit;

$root = dirname(__DIR__, 1);

require __DIR__ . '/functions.php';
require __DIR__ . '/constants.php';

// composer autoload
if (file_exists($autoload = $root . '/vendor/autoload.php')) {
    require $autoload;
}
