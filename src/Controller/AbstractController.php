<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Controller;

use OpenFakeGenerator\Model\Address;
use OpenFakeGenerator\Model\Bank;
use OpenFakeGenerator\Model\Company;
use OpenFakeGenerator\Model\Contact;
use OpenFakeGenerator\Model\ModelInterface;
use OpenFakeGenerator\Model\Person;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractController
{
    protected function getDatas(Request $request): ModelInterface
    {
        $preferred_language = (string) $request->get('locale', $request->getPreferredLanguage());
        $gender = $request->get('gender');
        $type = $request->get('type');

        $classname = match ($type) {
            'address' => Address::class,
            'bank' => Bank::class,
            'company' => Company::class,
            'contact' => Contact::class,
            default => Person::class,
        };

        if (false === \in_array($gender, ['male', 'female'], true)) {
            $gender = null;
        }

        if (\strlen($preferred_language) === 2) {
            $preferred_language .= '_'.\strtoupper($preferred_language);
        }

        return new $classname($preferred_language, $gender);
    }
}
