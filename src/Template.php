<?php

declare(strict_types=1);

namespace OpenFakeGenerator;

use Faker\Factory;
use Twig\Environment;
use Twig\TwigFilter;

class Template
{
    private const TEMPLATES_DIR = __DIR__.'/../templates';

    private string $locale;
    private static ?Translator $translator = null;
    private static ?Environment $twig = null;

    public function __construct(string $locale = Factory::DEFAULT_LOCALE)
    {
        $this->locale = $locale;
    }

    public function render(string $template, array $parameters)
    {
        return $this->getTwig()->load($template)->render($parameters);
    }

    private function getTranslator(string $locale = Factory::DEFAULT_LOCALE): Translator
    {
        if (null === self::$translator) {
            self::$translator = new Translator($locale);
        }

        return self::$translator;
    }

    private function getTwig(): Environment
    {
        if (null === self::$twig) {
            $loader = new \Twig\Loader\FilesystemLoader(self::TEMPLATES_DIR);
            self::$twig = new Environment($loader, [
//                'cache' => App::CACHE_DIR,
            ]);

            $translator = $this->getTranslator($this->locale);

            self::$twig->addFilter(new TwigFilter('trans', function (string $source, array $parameters = [], string $domain = null) use ($translator) {
                return $translator->trans($source, $parameters, $domain);
            }));

            self::$twig->addGlobal('language', $this->locale);
        }

        return self::$twig;
    }
}
