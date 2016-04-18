<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi;

use InvalidArgumentException;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use RuntimeException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\AbstractProvider;

/**
 * Class Yasumi.
 */
class Yasumi
{
    /**
     * Default locale.
     */
    const DEFAULT_LOCALE = 'en_US';

    /**
     * @var array list of all defined locales
     */
    private static $locales;

    /**
     * Global translations.
     *
     * @var Translations
     */
    private static $globalTranslations;

    /**
     * Provider class to be ignored (Abstract, trait, other)
     *
     * @var array
     */
    private static $ignoredProvider = [
        'AbstractProvider.php',
        'CommonHolidays.php',
        'ChristianHolidays.php',
    ];

    /**
     * Create a new holiday provider instance.
     *
     * @param string $class  holiday provider name
     * @param int    $year   year for which the country provider needs to be created. Year needs to be a valid integer
     *                       between 1000 and 9999.
     * @param string $locale The locale to use. If empty we'll use the default locale (en_US)
     *
     * @throws RuntimeException         If no such holiday provider is found
     * @throws InvalidArgumentException if the year parameter is not between 1000 and 9999
     * @throws UnknownLocaleException   if the locale parameter is invalid
     * @throws InvalidArgumentException if the holiday provider for the given country does not exist
     *
     * @return AbstractProvider An instance of class $class is created and returned
     */
    public static function create($class, $year = null, $locale = self::DEFAULT_LOCALE)
    {
        // Find and return holiday provider instance
        $providerClass = sprintf('Yasumi\Provider\%s', str_replace('/', '\\', $class));
        if (!class_exists($providerClass) || $class === 'AbstractProvider') {
            throw new InvalidArgumentException(sprintf('Unable to find holiday provider "%s".', $class));
        }

        // Assert year input
        if ($year < 1000 || $year > 9999) {
            throw new InvalidArgumentException(sprintf('Year needs to be between 1000 and 9999 (%s given).', $year));
        }

        // Load internal locales variable
        if (!isset(static::$locales)) {
            static::$locales = self::getAvailableLocales();
        }

        // Load internal translations variable
        if (!isset(static::$globalTranslations)) {
            static::$globalTranslations = new Translations(static::$locales);
            static::$globalTranslations->loadTranslations(__DIR__.'/data/translations');
        }

        // Assert locale input
        if (!in_array($locale, static::$locales)) {
            throw new UnknownLocaleException(sprintf('Locale "%s" is not a valid locale.', $locale));
        }

        return new $providerClass($year, $locale, self::$globalTranslations);
    }

    /**
     * Returns a list of available locales.
     *
     * @return array list of available locales
     */
    public static function getAvailableLocales()
    {
        return require __DIR__.'/data/locales.php';
    }

    /**
     * @param $provider
     *
     * @return bool
     */
    public static function isProvider($provider)
    {
        return in_array($provider, self::getProviders());
    }

    /**
     * Returns a list of available holiday providers.
     *
     * @return array list of available holiday providers
     */
    public static function getProviders()
    {
        //Basic static cache
        static $providers;
        if ($providers !== null) {
            return $providers;
        }

        $extension = 'php';
        $providers = [];
        $filesIterator = new \RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(__DIR__.'/Provider/'),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($filesIterator as $file) {
            if ($file->isFile() === false
                || in_array($file->getBasename(), self::$ignoredProvider)
                || $file->getExtension() !== $extension
            ) {
                continue;
            }

            $provider = preg_replace('#^.+/Provider/(.+)\.php$#', '$1', $file->getPathName());

            $providers[] = $provider;
        }

        return (array) $providers;
    }
}
