<?php

namespace PseudoVendor\PseudoPlugin;

use Leonidas\Contracts\Extension\WpExtensionInterface;
use Leonidas\Framework\Exceptions\PluginAlreadyLoadedException;

final class PseudoPlugin
{
    /**
     * @var WpExtensionInterface
     */
    protected $base;

    /**
     * @var PseudoPlugin
     */
    private static $instance;

    private function __construct(WpExtensionInterface $base)
    {
        $this->base = $base;
    }

    public static function launch(WpExtensionInterface $base): void
    {
        if (!self::isLoaded()) {
            self::create($base);
        }

        self::throwAlreadyLoadedException(__METHOD__);
    }

    private static function isLoaded(): bool
    {
        return isset(self::$instance) && (self::$instance instanceof self);
    }

    private static function create(WpExtensionInterface $base): void
    {
        self::$instance = new self($base);
    }

    private static function throwAlreadyLoadedException(callable $method): void
    {
        throw new PluginAlreadyLoadedException(
            self::$instance->base->getName(),
            $method
        );
    }
}