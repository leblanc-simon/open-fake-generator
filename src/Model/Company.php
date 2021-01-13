<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Model;

use Faker\Factory;

class Company implements ModelInterface
{
    public $name;
    public $siret;
    public $siren;
    public $vat;
    public $address;
    public $contact;
    public $bank;

    public function __construct(string $locale = Factory::DEFAULT_LOCALE, ?string $gender = null)
    {
        $faker = Factory::create($locale);

        $this->name = $faker->company;
        $this->address = new Address($locale);
        $this->contact = new Contact($locale);
        $this->bank = new Bank($locale);

        try {
            $this->vat = $faker->vat;
            $this->siret = $faker->siret;
            $this->siren = $faker->siren;
        } catch (\InvalidArgumentException $e) {
        }
    }
}
