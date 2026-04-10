<?php

namespace KoenSchipper\AddressParser;

class LaravelAddressParser
{
    public static function parse(string $address): Address
    {
        $addressString = trim($address);
        $result = new Address();

        if (empty($addressString)) {
            return $result;
        }

        $postcodeRegex = '/([1-9][0-9]{3})\s?([A-Z]{2})\b/i';
        if (preg_match($postcodeRegex, $addressString, $matches, PREG_OFFSET_CAPTURE)) {
            $result->postcode = strtoupper($matches[1][0] . ' ' . $matches[2][0]);
            $postcodePos = $matches[0][1];
            $postcodeEnd = $postcodePos + strlen($matches[0][0]);

            $afterPostcode = trim(substr($addressString, $postcodeEnd), " ,");
            if (!empty($afterPostcode)) {
                $result->city = $afterPostcode;
            }

            $addressString = trim(substr($addressString, 0, $postcodePos), " ,");
        }

        if (preg_match('/^(.+)\s+(\d+[\s\-\/]*.*)$/u', $addressString, $matches)) {
             $result->street = trim($matches[1]);
             $potentialNumber = trim($matches[2]);

             $result->fullHouseNumber = $potentialNumber;

             if (preg_match('/^(\d+)\s*(.*)$/', $potentialNumber, $numMatches)) {
                 $result->houseNumber = $numMatches[1];
                 $result->houseNumberAddition = trim($numMatches[2], " -/");
             }
        }
        elseif (preg_match('/^([a-zA-Z\s\.\-]+)(\d+.*)$/u', $addressString, $matches)) {
             $result->street = trim($matches[1]);
             $potentialNumber = trim($matches[2]);

             $result->fullHouseNumber = $potentialNumber;

             if (preg_match('/^(\d+)\s*(.*)$/', $potentialNumber, $numMatches)) {
                 $result->houseNumber = $numMatches[1];
                 $result->houseNumberAddition = trim($numMatches[2], " -/");
             }
        } else {
            $result->street = $addressString;
        }

        return $result;
    }

    public static function parseAddress(string $address): array
    {
        $result = self::parse($address);

        return [
            'street' => $result->street,
            'house_number' => $result->fullHouseNumber,
        ];
    }
}
