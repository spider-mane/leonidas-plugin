<?php

namespace PseudoVendor\PseudoPlugin;

function plugin_header(string $header)
{
    return PseudoPlugin::instance()->header($header);
}

function path(?string $file = null): string
{
    return PseudoPlugin::instance()->path($file);
}

function abspath(?string $file = null): string
{
    return PseudoPlugin::instance()->absPath($file);
}

function url(?string $file = null): string
{
    return PseudoPlugin::instance()->url($file);
}
