<?php

$root = dirname(__DIR__, 1);

if (file_exists($autoload = $root . '/vendor/autoload.php')) {
    require $autoload;
}
