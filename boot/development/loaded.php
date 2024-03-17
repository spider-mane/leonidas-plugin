<?php

use WebTheory\WpTest\SkyHooks;

$root = dirname(__DIR__, 2);

# Initiate SkyHooks
SkyHooks::init();

# Load playground context
if (file_exists($playground = "{$root}/@playground/loaded.php")) {
    require $playground;
}
