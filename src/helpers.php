<?php

use KoenSchipper\AddressParser\LaravelAddressParser;
use KoenSchipper\AddressParser\Address;

if (! function_exists('parse_dutch_address')) {
    /**
     * Parse a Dutch address string.
     */
    function parse_dutch_address(string $address): Address
    {
        return LaravelAddressParser::parse($address);
    }
}
