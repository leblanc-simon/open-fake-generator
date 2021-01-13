<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Model;

use Faker\Factory;

class Bank implements ModelInterface
{
    public $type;
    public $number;
    public $holder_name;
    public $expiration_date;
    public $iban;
    public $swift_bic;
    public $bank_account_number;

    public function __construct(string $locale = Factory::DEFAULT_LOCALE, ?string $gender = null)
    {
        $faker = Factory::create($locale);

        $credit_card = $faker->creditCardDetails;
        $this->type = $credit_card['type'];
        $this->number = $credit_card['number'];
        $this->holder_name = $credit_card['name'];
        $this->expiration_date = $credit_card['expirationDate'];
        $this->iban = $faker->iban();
        $this->swift_bic = $faker->swiftBicNumber;

        try {
            $this->bank_account_number = $faker->bankAccountNumber;
        } catch (\InvalidArgumentException $e) {
        }
    }
}
