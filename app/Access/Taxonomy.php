<?php

namespace PseudoVendor\PseudoPlugin\Access;

use Leonidas\Library\System\Model\Taxonomy\TaxonomyFactory;

class Taxonomy extends _Facade
{
    protected static function _getFacadeAccessor()
    {
        return TaxonomyFactory::class;
    }
}
