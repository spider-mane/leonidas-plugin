<?php

namespace PseudoVendor\PseudoPlugin\Modules;

use Leonidas\Contracts\Ui\Asset\ScriptCollectionInterface;
use Leonidas\Contracts\Ui\Asset\StyleCollectionInterface;
use Leonidas\Framework\Module\Abstracts\AdminAssetProviderModule;
use Leonidas\Library\Core\Asset\ScriptBuilder;
use Leonidas\Library\Core\Asset\ScriptCollection;
use Leonidas\Library\Core\Asset\StyleBuilder;
use Leonidas\Library\Core\Asset\StyleCollection;

final class AdminAssets extends AdminAssetProviderModule
{
    protected function styles(): StyleCollectionInterface
    {
        return StyleCollection::from([

            StyleBuilder::for('pseudo-plugin')
                ->src($this->asset('/css/styles.css'))
                ->version($this->version('1.0.0'))
                ->enqueue(true)
                ->done(),

        ]);
    }

    protected function scripts(): ScriptCollectionInterface
    {
        return ScriptCollection::from([

            ScriptBuilder::for('pseudo-plugin')
                ->src($this->asset('/js/script.js'))
                ->version($this->version('1.0.0'))
                ->dependencies('pseudo-plugin-manifest', 'pseudo-plugin-vendors')
                ->inFooter(true)
                ->enqueue(true)
                ->done(),

            ScriptBuilder::for('pseudo-plugin-manifest')
                ->src($this->asset('/js/manifest.js'))
                ->version($this->version())
                ->inFooter(true)
                ->done(),

            ScriptBuilder::for('pseudo-plugin-vendors')
                ->src($this->asset('/js/vendor.js'))
                ->version($this->version())
                ->dependencies('pseudo-theme-manifest')
                ->inFooter(true)
                ->done(),

        ]);
    }
}
