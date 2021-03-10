<?php

use League\Container\Container;
use Noodlehaus\ConfigInterface;
use WebTheory\GuctilityBelt\Config;

$container = new Container();

// register config
$container->add(ConfigInterface::class, function () {
    return new Config(realpath('../config'));
})->setAlias('config')->setShared(true);


// bootstrap providers
$providers = $container->get('config')->get('app.providers', []);

foreach ($providers as $provider) {
    $container->addServiceProvider($provider);
}


// return bootstrapped container
return $container;
