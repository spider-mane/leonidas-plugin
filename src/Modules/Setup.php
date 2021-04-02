<?php

namespace PseudoVendor\PseudoPlugin\Modules;

use Leonidas\Contracts\Extension\ModuleInterface;
use Leonidas\Framework\Modules\AbstractPluginSetupModule;

final class Setup extends AbstractPluginSetupModule implements ModuleInterface
{
    protected function activate(bool $networkWide): void
    {
        //
    }

    protected function deactivate(bool $networkDeactivating): void
    {
        //
    }

    public static function uninstall(): void
    {
        //
    }
}
