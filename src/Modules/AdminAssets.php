<?php

namespace PseudoVendor\PseudoPlugin\Modules;

use Leonidas\Contracts\Ui\Asset\ScriptCollectionInterface;
use Leonidas\Contracts\Ui\Asset\StyleCollectionInterface;
use Leonidas\Framework\Modules\AbstractAdminAssetProviderModule;
use Leonidas\Library\Core\Asset\ScriptCollection;
use Leonidas\Library\Core\Asset\StyleCollection;

final class AdminAssets extends AbstractAdminAssetProviderModule
{
    protected function styles(): ?StyleCollectionInterface
    {
        return StyleCollection::with(
            //
        );
    }

    protected function scripts(): ?ScriptCollectionInterface
    {
        return ScriptCollection::with(
            //
        );
    }
}
