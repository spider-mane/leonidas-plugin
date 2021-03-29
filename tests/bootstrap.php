<?php

$root = dirname(__FILE__, 2);

if (file_exists($autoload = $root . '/vendor/autoload.php')) {
    require $autoload;
}
