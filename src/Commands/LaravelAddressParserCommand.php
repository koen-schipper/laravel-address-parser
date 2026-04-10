<?php

namespace KoenSchipper\AddressParser\Commands;

use Illuminate\Console\Command;

class LaravelAddressParserCommand extends Command
{
    public $signature = 'address:parse {address}';

    public $description = 'Parse a Dutch address string';

    public function handle(): int
    {
        $addressString = $this->argument('address');
        $address = \KoenSchipper\AddressParser\LaravelAddressParser::parse($addressString);

        $this->table(
            ['Field', 'Value'],
            [
                ['Street', $address->street],
                ['Number', $address->houseNumber],
                ['Addition', $address->houseNumberAddition],
                ['Full Number', $address->fullHouseNumber],
                ['Postcode', $address->postcode],
                ['City', $address->city],
            ]
        );

        return self::SUCCESS;
    }
}
