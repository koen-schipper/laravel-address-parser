<?php

namespace KoenSchipper\AddressParser\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \KoenSchipper\AddressParser\LaravelAddressParser
 */
class LaravelAddressParser extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \KoenSchipper\AddressParser\LaravelAddressParser::class;
    }
}
