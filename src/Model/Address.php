<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Model;

use Faker\Factory;

class Address implements ModelInterface
{
    public $street;
    public $secondary_street;
    public $postcode;
    public $city;
    public $country;
    public $latitude;
    public $longitude;

    public $department_name;
    public $department_number;
    public $region;

    public function __construct(string $locale = Factory::DEFAULT_LOCALE, ?string $gender = null)
    {
        $faker = Factory::create($locale);

        $this->street = $faker->streetAddress;
        if (true === $faker->boolean) {
            $this->secondary_street = $faker->secondaryAddress;
        }
        $this->postcode = $faker->postcode;
        $this->city = $faker->city;
        $this->country = $faker->country;
        $this->latitude = $faker->latitude;
        $this->longitude = $faker->longitude;

        try {
            $department = $faker->department;
            $this->department_name = \current($department);
            $this->department_number = \key($department);
            $this->region = $faker->region ?? null;
        } catch (\InvalidArgumentException $e) {
        }
    }
}
