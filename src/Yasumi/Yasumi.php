<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi;

use IntlCalendar;
use InvalidArgumentException;
use RuntimeException;
use Yasumi\Exception\UnknownLocaleException;

/**
 * Class Yasumi
 *
 * @package Yasumi
 */
class Yasumi
{
    /**
     * Default locale
     */
    const DEFAULT_LOCALE = 'en_US';

    /**
     * @var array list of all defined locales
     */
    private static $locales;

    /**
     * Create a new holiday provider instance.
     *
     * @param string $class  holiday provider name
     * @param int    $year   year for which the country provider needs to be created. Year needs to be a valid integer
     *                       between 1000 and 9999.
     * @param string $locale The locale to use. If empty we'll use the default locale (en-US)
     *
     * @throws RuntimeException If no such holiday provider is found
     * @throws InvalidArgumentException if the year parameter is not between 0 and 9999
     * @throws UnknownLocaleException if the locale parameter is invalid
     * @throws InvalidArgumentException if the holiday provider for the given country does not exist
     *
     * @return object An instance of class $class is created and returned
     */
    public static function create($class, $year = null, $locale = self::DEFAULT_LOCALE)
    {
        // Find and return holiday provider instance
        $providerClass = sprintf('Yasumi\Provider\%s', $class);
        if ( ! class_exists($providerClass)) {
            throw new InvalidArgumentException(sprintf('Unable to find holiday provider "%s".', $class));
        }

        // Assert year input
        if ($year < 1000 || $year > 9999) {
            throw new InvalidArgumentException(sprintf('Year needs to be between 0 and 9999 (%s given).', $year));
        }

        // Load internal locales variable
        if ( ! isset(static::$locales)) {
            static::$locales = self::getAvailableLocales();
        }

        // Assert locale input
        if ( ! in_array($locale, static::$locales)) {
            throw new UnknownLocaleException(sprintf('Locale "%s" is not a valid locale.', $locale));
        }

        return new $providerClass($year, $locale);
    }

    /**
     * Returns a list of available locales.
     *
     * This function relies on the 'intl' extension to be loaded. In case this extension is not available/loaded, a
     * static list of locales will be used.
     *
     * @return array list of available locales
     */
    public static function getAvailableLocales()
    {
        if (class_exists('IntlCalendar')) {
            return IntlCalendar::getAvailableLocales();
        }

        return require_once __DIR__ . '/data/locales.php';
    }
}
