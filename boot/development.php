<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

define(':plugin_cap_name_DEVELOPMENT', 1);

# display errors in dev environment
ini_set('display_errors', '1');

(new Run())->prependHandler(new PrettyPageHandler())->register();
