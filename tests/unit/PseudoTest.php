<?php

use Composer\Installers\Plugin;
use PHPUnit\Framework\TestCase;
use PseudoVendor\PseudoPlugin\Launcher;

class LauncherTest extends TestCase
{
    /**
     * @var Launcher
     */
    protected $launcher;

    public function testInits()
    {
        Launcher::init(
            plugin_basename(__FILE__),
            plugin_dir_path(__FILE__),
            plugin_dir_url(__FILE__),
        );
    }
}
