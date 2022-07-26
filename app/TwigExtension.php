<?php

namespace PseudoVendor\PseudoPlugin;

use Leonidas\Library\Core\View\Twig\Abstracts\AbstractConfigurationExtension;

class TwigExtension extends AbstractConfigurationExtension
{
    protected function functions(): array
    {
        return [];
    }

    protected function filters(): array
    {
        return [];
    }
}
