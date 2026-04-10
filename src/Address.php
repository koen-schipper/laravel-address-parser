<?php

namespace KoenSchipper\AddressParser;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class Address implements Arrayable, Jsonable, JsonSerializable
{
    public function __construct(
        public string $street = '',
        public string $houseNumber = '',
        public string $houseNumberAddition = '',
        public string $postcode = '',
        public string $city = '',
        public string $fullHouseNumber = '',
    ) {
    }

    public function toArray(): array
    {
        return [
            'street' => $this->street,
            'house_number' => $this->houseNumber,
            'house_number_addition' => $this->houseNumberAddition,
            'full_house_number' => $this->fullHouseNumber,
            'postcode' => $this->postcode,
            'city' => $this->city,
        ];
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            street: $data['street'] ?? '',
            houseNumber: $data['house_number'] ?? '',
            houseNumberAddition: $data['house_number_addition'] ?? '',
            postcode: $data['postcode'] ?? '',
            city: $data['city'] ?? '',
            fullHouseNumber: $data['full_house_number'] ?? '',
        );
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
