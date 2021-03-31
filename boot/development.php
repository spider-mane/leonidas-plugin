<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

(new Run())->prependHandler(new PrettyPageHandler())->register();

ini_set('display_errors', '1');

define('PSEUDO_CONSTANT_DEVELOPMENT', 1);
