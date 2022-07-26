<?php

namespace PseudoVendor\PseudoPlugin\Access;

use Leonidas\Library\Admin\Field\Factory\Field;

class AdminField extends _Facade
{
    protected static function _getFacadeAccessor()
    {
        return Field::class;
    }
}
