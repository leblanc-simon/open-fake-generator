<?php

declare(strict_types=1);

namespace OpenFakeGenerator;

use Faker\Factory;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Contracts\Translation\TranslatorInterface;

class Translator
{
    private const TRANSLATIONS_DIR = __DIR__.'/../translations';

    private TranslatorInterface $translator;

    public function __construct(string $locale = Factory::DEFAULT_LOCALE)
    {
        $this->translator = new \Symfony\Component\Translation\Translator($locale);
        $this->translator->addLoader('array', new ArrayLoader());

        $translations = $this->getTranslations($locale);
        foreach ($translations as $domain => $translation) {
            $this->translator->addResource('array', $translation, $locale, $domain);
        }
    }

    public function trans(string $id, array $parameters = [], string $domain = null, string $locale = null)
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }

    private function getTranslations(string $locale): array
    {
        if (true === \file_exists(self::TRANSLATIONS_DIR.'/'.$locale.'.php')) {
            return include self::TRANSLATIONS_DIR.'/'.$locale.'.php';
        }

        if (\strlen($locale) > 2 && false !== \strpos($locale, '_')) {
            $short_locale = \current(\explode('_', $locale));
            if (true === \file_exists(self::TRANSLATIONS_DIR.'/'.$short_locale.'.php')) {
                return include self::TRANSLATIONS_DIR.'/'.$short_locale.'.php';
            }
        }

        if (\strlen($locale) > 2 && false !== \strpos($locale, '-')) {
            $short_locale = \current(\explode('-', $locale));
            if (true === \file_exists(self::TRANSLATIONS_DIR.'/'.$short_locale.'.php')) {
                return include self::TRANSLATIONS_DIR.'/'.$short_locale.'.php';
            }
        }

        return [];
    }
}
