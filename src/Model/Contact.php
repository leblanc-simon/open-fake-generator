<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Model;

use Faker\Factory;

class Contact implements ModelInterface
{
    public $email;
    public $phone;
    public $mobile;

    public function __construct(string $locale = Factory::DEFAULT_LOCALE, ?string $gender = null)
    {
        $faker = Factory::create($locale);

        $this->email = $faker->email;
        $this->phone = $faker->phoneNumber;

        try {
            $this->mobile = $faker->mobileNumber;
        } catch (\InvalidArgumentException $e) {
        }
    }
}
