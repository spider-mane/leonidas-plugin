<?php

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\Dumper\ServerDumper;
use Symfony\Component\VarDumper\VarDumper;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

define('PSEUDO_CONSTANT_DEVELOPMENT', 1);

ini_set('display_errors', '1');
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);
ini_set('xdebug.var_display_max_depth', 10);

// whoops error handling
call_user_func(function () {
    $htmlHandler = new PrettyPageHandler();
    $run = new Run();

    $run->prependHandler($htmlHandler)->register();
});

// symfony var dump server
call_user_func(function () {
    $cloner = new VarCloner();
    $fallbackDumper = in_array(PHP_SAPI, ['cli', 'phpdbg']) ? new CliDumper() : new HtmlDumper();
    $dumper = new ServerDumper('tcp://127.0.0.1:9912', $fallbackDumper, [
        'cli' => new CliContextProvider(),
        'source' => new SourceContextProvider(),
    ]);

    VarDumper::setHandler(function ($var) use ($dumper, $cloner) {
        $dumper->dump($cloner->cloneVar($var));
    });
});

ob_start(); // required to make errors and var dumps display properly some wp-admin contexts
