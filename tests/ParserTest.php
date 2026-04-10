<?php

use KoenSchipper\AddressParser\LaravelAddressParser;

it('parses simple addresses', function () {
    $result = LaravelAddressParser::parseAddress('Kerkstraat 1');
    expect($result['street'])->toBe('Kerkstraat')
        ->and($result['house_number'])->toBe('1');
});

it('parses addresses with simple additions', function () {
    $result = LaravelAddressParser::parseAddress('Kerkstraat 1a');
    expect($result['street'])->toBe('Kerkstraat')
        ->and($result['house_number'])->toBe('1a');
});

it('parses addresses with dash additions', function () {
    $result = LaravelAddressParser::parseAddress('Kerkstraat 1-a');
    expect($result['street'])->toBe('Kerkstraat')
        ->and($result['house_number'])->toBe('1-a');
});

it('parses complex street names', function () {
    $result = LaravelAddressParser::parseAddress('Jan van der Heijdenstraat 123');
    expect($result['street'])->toBe('Jan van der Heijdenstraat')
        ->and($result['house_number'])->toBe('123');
});

it('parses street names with numbers', function () {
    $result = LaravelAddressParser::parseAddress('Laan 1940-1945 10');
    expect($result['street'])->toBe('Laan 1940-1945')
        ->and($result['house_number'])->toBe('10');
});

it('parses addresses with bis addition', function () {
    $result = LaravelAddressParser::parseAddress('Dorpsstraat 1 bis');
    expect($result['street'])->toBe('Dorpsstraat')
        ->and($result['house_number'])->toBe('1 bis');
});

it('parses addresses with rood addition', function () {
    $result = LaravelAddressParser::parseAddress('Dorpsstraat 12 rood');
    expect($result['street'])->toBe('Dorpsstraat')
        ->and($result['house_number'])->toBe('12 rood');
});

it('parses addresses with ranges', function () {
    $result = LaravelAddressParser::parseAddress('Stationsplein 12-14');
    expect($result['street'])->toBe('Stationsplein')
        ->and($result['house_number'])->toBe('12-14');
});

it('parses addresses with postcode and city', function () {
    $result = \KoenSchipper\AddressParser\LaravelAddressParser::parse('Kerkstraat 1, 1234 AB Amsterdam');
    expect($result->street)->toBe('Kerkstraat')
        ->and($result->houseNumber)->toBe('1')
        ->and($result->postcode)->toBe('1234 AB')
        ->and($result->city)->toBe('Amsterdam');
});

it('parses addresses with postcode without space', function () {
    $result = \KoenSchipper\AddressParser\LaravelAddressParser::parse('Kerkstraat 1 1234AB Amsterdam');
    expect($result->street)->toBe('Kerkstraat')
        ->and($result->houseNumber)->toBe('1')
        ->and($result->postcode)->toBe('1234 AB')
        ->and($result->city)->toBe('Amsterdam');
});

it('parses addresses with house number addition and postcode', function () {
    $result = \KoenSchipper\AddressParser\LaravelAddressParser::parse('Dorpsstraat 12 bis 1234 AB Utrecht');
    expect($result->street)->toBe('Dorpsstraat')
        ->and($result->houseNumber)->toBe('12')
        ->and($result->houseNumberAddition)->toBe('bis')
        ->and($result->postcode)->toBe('1234 AB')
        ->and($result->city)->toBe('Utrecht');
});

it('parses street names starting with numbers', function () {
    $result = \KoenSchipper\AddressParser\LaravelAddressParser::parse('1e Jan van der Heijdenstraat 123');
    expect($result->street)->toBe('1e Jan van der Heijdenstraat')
        ->and($result->houseNumber)->toBe('123');
});

it('parses PO Box (Postbus) addresses', function () {
    $result = \KoenSchipper\AddressParser\LaravelAddressParser::parse('Postbus 123');
    expect($result->street)->toBe('Postbus')
        ->and($result->houseNumber)->toBe('123');
});

it('parses Antwoordnummer addresses', function () {
    $result = \KoenSchipper\AddressParser\LaravelAddressParser::parse('Antwoordnummer 123');
    expect($result->street)->toBe('Antwoordnummer')
        ->and($result->houseNumber)->toBe('123');
});

it('parses street name with numbers and postcode', function () {
    $result = \KoenSchipper\AddressParser\LaravelAddressParser::parse('Laan 1940-1945 10, 1234 AB Amsterdam');
    expect($result->street)->toBe('Laan 1940-1945')
        ->and($result->houseNumber)->toBe('10')
        ->and($result->postcode)->toBe('1234 AB')
        ->and($result->city)->toBe('Amsterdam');
});

it('parses street and number without space', function () {
    $result = \KoenSchipper\AddressParser\LaravelAddressParser::parse('Kerkstraat1');
    expect($result->street)->toBe('Kerkstraat')
        ->and($result->houseNumber)->toBe('1');
});
