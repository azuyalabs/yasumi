<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi;

use DateTime;
use InvalidArgumentException;
use JsonSerializable;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\MissingTranslationException;
use Yasumi\Exception\UnknownLocaleException;

/**
 * Class Holiday.
 */
class Holiday extends DateTime implements JsonSerializable
{
    /**
     * Type definition for Official (i.e. National/Federal) holidays.
     */
    public const TYPE_OFFICIAL = 'official';

    /**
     * Type definition for Observance holidays.
     */
    public const TYPE_OBSERVANCE = 'observance';

    /**
     * Type definition for seasonal holidays.
     */
    public const TYPE_SEASON = 'season';

    /**
     * Type definition for Bank holidays.
     */
    public const TYPE_BANK = 'bank';

    /**
     * Type definition for other type of holidays.
     */
    public const TYPE_OTHER = 'other';

    /**
     * The default locale. Used for translations of holiday names and other text strings.
     */
    public const DEFAULT_LOCALE = 'en_US';

    /**
     * Pseudo-locale representing the holiday key.
     */
    public const LOCALE_KEY = '_key';

    /**
     * @var string holiday key
     *
     * @deprecated Public access to this property is deprecated in favor of getKey()
     * @see getKey()
     */
    public $shortName;

    /**
     * @var array list of translations of this holiday
     */
    public $translations;

    /**
     * @var string identifies the type of holiday
     */
    protected $type;

    /**
     * @var string Locale (i.e. language) in which the holiday information needs to be displayed in. (Default 'en_US')
     */
    protected $displayLocale;

    /**
     * @var array list of all defined locales
     */
    private static $locales = [];

    /**
     * Creates a new Holiday.
     *
     * If a holiday date needs to be defined for a specific timezone, make sure that the date instance
     * (DateTimeInterface) has the correct timezone set. Otherwise the default system timezone is used.
     *
     * @param string             $key           Holiday key
     * @param array              $names         An array containing the name/description of this holiday in various
     *                                          languages. Overrides global translations
     * @param \DateTimeInterface $date          A DateTimeInterface instance representing the date of the holiday
     * @param string             $displayLocale Locale (i.e. language) in which the holiday information needs to be
     *                                          displayed in. (Default 'en_US')
     * @param string             $type          The type of holiday. Use the following constants: TYPE_OFFICIAL,
     *                                          TYPE_OBSERVANCE, TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an
     *                                          official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    public function __construct(
        string $key,
        array $names,
        \DateTimeInterface $date,
        string $displayLocale = self::DEFAULT_LOCALE,
        string $type = self::TYPE_OFFICIAL
    ) {
        // Validate if key is not empty
        if (empty($key)) {
            throw new InvalidArgumentException('Holiday name can not be blank.');
        }

        // Load internal locales variable
        if (empty(self::$locales)) {
            self::$locales = Yasumi::getAvailableLocales();
        }

        // Assert display locale input
        if (!\in_array($displayLocale, self::$locales, true)) {
            throw new UnknownLocaleException(sprintf('Locale "%s" is not a valid locale.', $displayLocale));
        }

        // Set additional attributes
        $this->shortName = $key;
        $this->translations = $names;
        $this->displayLocale = $displayLocale;
        $this->type = $type;

        // Construct instance
        parent::__construct($date->format('Y-m-d'), $date->getTimezone());
    }

    /**
     * Format the instance as a string using the set format.
     *
     * @return string this instance as a string using the set format
     */
    public function __toString(): string
    {
        return $this->format('Y-m-d');
    }

    /**
     * Returns the key for this holiday.
     *
     * @return string the key, e.g. "newYearsDay".
     */
    public function getKey(): string
    {
        return $this->shortName;
    }

    /**
     * Returns what type this holiday is.
     *
     * @return string the type of holiday (official, observance, season, bank or other)
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @return $this
     */
    public function jsonSerialize(): self
    {
        return $this;
    }

    /**
     * Returns the localized name of this holiday.
     *
     * The provided locales are searched for a translation. The first locale containing a translation will be used.
     *
     * If no locale is provided, proceed as if an array containing the display locale, Holiday::DEFAULT_LOCALE ('en_US'), and
     * Holiday::LOCALE_KEY (the holiday key) was provided.
     *
     * @param array|null $locales The locales to search for translations
     *
     * @throws MissingTranslationException
     *
     * @see Holiday::DEFAULT_LOCALE
     * @see Holiday::LOCALE_KEY
     */
    public function getName(array $locales = null): string
    {
        $locales = $this->getLocales($locales);
        foreach ($locales as $locale) {
            if (self::LOCALE_KEY === $locale) {
                return $this->shortName;
            }
            if (isset($this->translations[$locale])) {
                return $this->translations[$locale];
            }
        }

        throw new MissingTranslationException($this->shortName, $locales);
    }

    /**
     * Merges local translations (preferred) with global translations.
     *
     * @param TranslationsInterface $globalTranslations global translations
     */
    public function mergeGlobalTranslations(TranslationsInterface $globalTranslations): void
    {
        $holidayGlobalTranslations = $globalTranslations->getTranslations($this->shortName);
        $this->translations = array_merge($holidayGlobalTranslations, $this->translations);
    }

    /**
     * Expands the provided locale into an array of locales to check for translations.
     *
     * For each provided locale, return all locales including their parent locales. E.g.
     * ['ca_ES_VALENCIA', 'es_ES'] is expanded into ['ca_ES_VALENCIA', 'ca_ES', 'ca', 'es_ES', 'es'].
     *
     * If a string is provided, return as if this string, Holiday::DEFAULT_LOCALE, and Holiday::LOCALE_SHORT_NAM
     * was provided. E.g. 'de_DE' is expanded into ['de_DE', 'de', 'en_US', 'en', Holiday::LOCALE_KEY].
     *
     * If null is provided, return as if the display locale was provided as a string.
     *
     * @param array|null $locales Array of locales, or null if the display locale should be used
     *
     * @see Holiday::DEFAULT_LOCALE
     * @see Holiday::LOCALE_KEY
     */
    protected function getLocales(?array $locales): array
    {
        if (!empty($locales)) {
            $expanded = [];
        } else {
            $locales = [$this->displayLocale];
            // DEFAULT_LOCALE is 'en_US', and its parent is 'en'.
            $expanded = [self::LOCALE_KEY, 'en', 'en_US'];
        }

        // Expand e.g. ['de_DE', 'en_GB'] into  ['de_DE', 'de', 'en_GB', 'en'].
        foreach (array_reverse($locales) as $locale) {
            $parent = strtok($locale, '_');
            while ($child = strtok('_')) {
                $expanded[] = $parent;
                $parent .= '_'.$child;
            }
            $expanded[] = $locale;
        }

        return array_reverse($expanded);
    }
}
