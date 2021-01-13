<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Model;

use Faker\Factory;

class Person implements ModelInterface
{
    public $title;
    public $firstname;
    public $lastname;
    public $username;
    public $password;
    public $nir;
    public $birthdate;

    /** @var Address */
    public $address;

    /** @var Contact */
    public $contact;

    /** @var Company */
    public $company;

    /** @var Bank */
    public $bank;

    public function __construct(string $locale = Factory::DEFAULT_LOCALE, ?string $gender = null)
    {
        $faker = Factory::create($locale);

        $this->title = $faker->title($gender);
        $this->firstname = $faker->firstName($gender);
        $this->lastname = $faker->lastName;
        $this->username = $faker->userName;
        $this->password = $faker->password;

        $date_formate = \datefmt_create($locale, \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE);

        $this->birthdate = \datefmt_format($date_formate, $faker->dateTimeBetween('-90 years', '-13 years'));

        try {
            $this->nir = $faker->nir($gender);
        } catch (\InvalidArgumentException $e) {
            try {
                $this->nir = $faker->ssn();
            } catch (\InvalidArgumentException $e) {
            }
        }

        $this->address = new Address($locale);
        $this->contact = new Contact($locale);
        $this->company = new Company($locale);
        $this->bank = new Bank($locale);
    }
}
