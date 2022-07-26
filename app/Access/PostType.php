<?php

namespace PseudoVendor\PseudoPlugin\Access;

use Leonidas\Library\System\Model\PostType\PostTypeFactory;

class PostType extends _Facade
{
    protected static function _getFacadeAccessor()
    {
        return PostTypeFactory::class;
    }
}
