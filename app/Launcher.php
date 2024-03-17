<?php

namespace PseudoVendor\PseudoPlugin;

use Leonidas\Contracts\Extension\WpExtensionInterface;
use Leonidas\Framework\Plugin\PluginLoader;

final class Launcher
{
    private PluginLoader $loader;

    private WpExtensionInterface $extension;

    private static self $instance;

    private function __construct(string $base)
    {
        $this->loader = new PluginLoader($base);
        $this->extension = $this->loader->getExtension();
    }

    private function launch(): void
    {
        $this->initiatePlugin()->bootExtension()->broadcastCompletion();
    }

    private function initiatePlugin(): self
    {
        PseudoPlugin::init($this->extension);

        return $this;
    }

    private function bootExtension(): self
    {
        $this->loader->bootstrap();

        return $this;
    }

    private function broadcastCompletion(): void
    {
        $this->extension->doAction('loaded');
    }

    public static function init(string $base): void
    {
        !isset(self::$instance)
            ? self::load($base)
            : self::$instance->loader->error();
    }

    private static function load(string $base): void
    {
        $hook = 'leonidas/loaded';
        $load = fn () => (self::$instance = new self($base))->launch();

        did_action($hook) ? $load() : add_action($hook, $load);
    }
}
