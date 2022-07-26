<?php

namespace PseudoVendor\PseudoPlugin\Bootstrap;

use Leonidas\Contracts\Extension\ExtensionBootProcessInterface;
use Leonidas\Framework\Bootstrap\Abstracts\AbstractModelRegistrar;

class RegisterModelServices extends AbstractModelRegistrar implements ExtensionBootProcessInterface
{
    protected const CONTRACTS = 'PseudoVendor\PseudoPlugin\Library\Interfaces\Models';
}
