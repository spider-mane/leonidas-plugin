<?php

use PseudoVendor\PseudoPlugin\Launcher;
use Tests\Support\TestCase;

class LauncherTest extends TestCase
{
    /**
     * @var Launcher
     */
    protected $launcher;

    /**
     * @test
     */
    public function it_inits()
    {
        Launcher::init(
            plugin_basename(__FILE__),
            plugin_dir_path(__FILE__),
            plugin_dir_url(__FILE__),
        );
    }
}
