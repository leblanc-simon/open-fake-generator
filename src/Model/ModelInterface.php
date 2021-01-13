<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Model;

use Faker\Factory;

interface ModelInterface
{
    public function __construct(string $locale = Factory::DEFAULT_LOCALE, ?string $gender = null);
}
