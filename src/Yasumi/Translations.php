<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi;

use DirectoryIterator;
use InvalidArgumentException;
use Yasumi\Exception\UnknownLocaleException;

/**
 * Class Translations.
 */
class Translations implements TranslationsInterface
{
    /**
     * @var array<string,array> translations array: ['<holiday key>' => ['<locale>' => 'translation', ...], ... ]
     */
    public array $translations = [];

    /**
     * @var array<string> list of all defined locales
     */
    private array $availableLocales;

    /**
     * Constructor.
     *
     * @param array<string> $availableLocales list of all defined locales
     */
    public function __construct(array $availableLocales)
    {
        $this->availableLocales = $availableLocales;
    }

    /**
     * Loads translations from directory.
     *
     * @param string $directoryPath directory path for translation files
     *
     * @throws UnknownLocaleException
     * @throws InvalidArgumentException
     */
    public function loadTranslations(string $directoryPath): void
    {
        if (!file_exists($directoryPath)) {
            throw new InvalidArgumentException('Directory with translations not found');
        }

        $directoryPath = rtrim($directoryPath, '/\\').DIRECTORY_SEPARATOR;
        $extension = 'php';

        foreach (new DirectoryIterator($directoryPath) as $file) {
            if ($file->isDot() || $file->isDir()) {
                continue;
            }

            if ($file->getExtension() !== $extension) {
                continue;
            }

            $filename = $file->getFilename();
            $key = $file->getBasename('.'.$extension);

            $translations = require $directoryPath.$filename;

            if (\is_array($translations)) {
                foreach (array_keys($translations) as $locale) {
                    $this->checkLocale((string) $locale);
                }

                $this->translations[$key] = $translations;
            }
        }
    }

    /**
     * Adds translation for holiday in specific locale.
     *
     * @param string $key         holiday key
     * @param string $locale      locale
     * @param string $translation translation
     *
     * @throws UnknownLocaleException
     */
    public function addTranslation(string $key, string $locale, string $translation): void
    {
        $this->checkLocale($locale);

        if (!\array_key_exists($key, $this->translations)) {
            $this->translations[$key] = [];
        }

        $this->translations[$key][$locale] = $translation;
    }

    /**
     * Returns translation for holiday in specific locale.
     *
     * @param string $key    holiday key
     * @param string $locale locale
     *
     * @return string|null translated holiday name
     */
    public function getTranslation(string $key, string $locale): ?string
    {
        if (!\array_key_exists($key, $this->translations)
            || !\array_key_exists($locale, $this->translations[$key])) {
            return null;
        }

        return $this->translations[$key][$locale];
    }

    /**
     * Returns all available translations for holiday.
     *
     * @param string $key holiday key
     *
     * @return array<string, string> holiday name translations ['<locale>' => '<translation>', ...]
     */
    public function getTranslations(string $key): array
    {
        if (!\array_key_exists($key, $this->translations)) {
            return [];
        }

        return $this->translations[$key];
    }

    private function checkLocale(string $locale): void
    {
        if (!\in_array($locale, $this->availableLocales, true)) {
            throw new UnknownLocaleException(sprintf('Locale "%s" is not a valid locale.', $locale));
        }
    }
}
