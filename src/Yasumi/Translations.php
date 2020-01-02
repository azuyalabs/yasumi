<?php declare(strict_types=1);

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
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
     * @var array translations array: ['<holiday short name>' => ['<locale>' => 'translation', ...], ... ]
     */
    public $translations = [];

    /**
     * @var array list of all defined locales
     */
    private $availableLocales;

    /**
     * Constructor.
     *
     * @param array $availableLocales list of all defined locales
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
        if (!\file_exists($directoryPath)) {
            throw new InvalidArgumentException('Directory with translations not found');
        }

        $directoryPath = \rtrim($directoryPath, '/\\') . DIRECTORY_SEPARATOR;
        $extension = 'php';

        foreach (new DirectoryIterator($directoryPath) as $file) {
            if ($file->isDot() || $file->isDir()) {
                continue;
            }

            if ($file->getExtension() !== $extension) {
                continue;
            }

            $filename = $file->getFilename();
            $shortName = $file->getBasename('.' . $extension);

            $translations = require $directoryPath . $filename;

            if (\is_array($translations)) {
                foreach (\array_keys($translations) as $locale) {
                    $this->isValidLocale($locale); // Validate the given locale
                }

                $this->translations[$shortName] = $translations;
            }
        }
    }

    /**
     * Checks whether the given locale is a valid/available locale.
     *
     * @param string $locale locale the locale to be validated
     *
     * @return true upon success, otherwise an UnknownLocaleException is thrown
     *
     * @throws UnknownLocaleException An UnknownLocaleException is thrown if the given locale is not
     *                                valid/available.
     *
     */
    protected function isValidLocale(string $locale): bool
    {
        if (!\in_array($locale, $this->availableLocales, true)) {
            throw new UnknownLocaleException(\sprintf('Locale "%s" is not a valid locale.', $locale));
        }

        return true;
    }

    /**
     * Adds translation for holiday in specific locale.
     *
     * @param string $shortName holiday short name
     * @param string $locale locale
     * @param string $translation translation
     *
     * @throws UnknownLocaleException
     */
    public function addTranslation(string $shortName, string $locale, string $translation): void
    {
        $this->isValidLocale($locale); // Validate the given locale

        if (!\array_key_exists($shortName, $this->translations)) {
            $this->translations[$shortName] = [];
        }

        $this->translations[$shortName][$locale] = $translation;
    }

    /**
     * Returns translation for holiday in specific locale.
     *
     * @param string $shortName holiday short name
     * @param string $locale locale
     *
     * @return string|null translated holiday name
     */
    public function getTranslation(string $shortName, string $locale): ?string
    {
        if (!\array_key_exists($shortName, $this->translations)
            || !\array_key_exists($locale, $this->translations[$shortName])) {
            return null;
        }

        return $this->translations[$shortName][$locale];
    }

    /**
     * Returns all available translations for holiday.
     *
     * @param string $shortName holiday short name
     *
     * @return array holiday name translations ['<locale>' => '<translation>', ...]
     */
    public function getTranslations(string $shortName): array
    {
        if (!\array_key_exists($shortName, $this->translations)) {
            return [];
        }

        return $this->translations[$shortName];
    }
}
