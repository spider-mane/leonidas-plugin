<?php

namespace PseudoVendor\PseudoPlugin\Setup;

use Leonidas\Contracts\Extension\PluginActivatorInterface;
use Leonidas\Contracts\Extension\WpExtensionInterface;

final class vPseudoVersion implements PluginActivatorInterface
{
    /**
     * @var WpExtensionInterface
     */
    protected $base;

    public function __construct(WpExtensionInterface $base)
    {
        $this->base = $base;
    }

    public function install(bool $networkWide): void
    {
        //
    }

    public function update(): void
    {
        //
    }
}
