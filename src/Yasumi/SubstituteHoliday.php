<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi;

use Yasumi\Exception\MissingTranslationException;
use Yasumi\Exception\UnknownLocaleException;

/**
 * Class SubstituteHoliday.
 *
 * A substitute holiday is a holiday given in lieu of another holiday, if that day falls in a weekend or
 * overlaps with other holidays, so that people do not "lose" a day off in these years.
 *
 * @see https://en.wikipedia.org/wiki/Substitute_holiday
 */
class SubstituteHoliday extends Holiday
{
    /**
     * @deprecated public access to this property is deprecated in favor of getSubstitutedHoliday()
     * @see getSubstitutedHoliday()
     */
    public Holiday $substitutedHoliday;

    /**
     * @var array<string> list of translations of the "{0} observed" pattern
     */
    public array $substituteHolidayTranslations;

    /**
     * Creates a new SubstituteHoliday.
     *
     * If a holiday date needs to be defined for a specific timezone, make sure that the date instance
     * (DateTimeInterface) has the correct timezone set. Otherwise, the default system timezone is used.
     *
     * @param Holiday               $substitutedHoliday The holiday being substituted
     * @param array<string, string> $names              An array containing the name/description of this holiday
     *                                                  in various languages. Overrides global translations
     * @param \DateTimeInterface    $date               A DateTimeInterface instance representing the date of the holiday
     * @param string                $displayLocale      Locale (i.e. language) in which the holiday information needs to
     *                                                  be displayed in. (Default 'en_US')
     * @param string                $type               The type of holiday. Use the following constants: TYPE_OFFICIAL,
     *                                                  TYPE_OBSERVANCE, TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default,
     *                                                  an official holiday is considered.
     *
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function __construct(
        Holiday $substitutedHoliday,
        array $names,
        \DateTimeInterface $date,
        string $displayLocale = self::DEFAULT_LOCALE,
        string $type = self::TYPE_OFFICIAL
    ) {
        $this->substitutedHoliday = $substitutedHoliday;

        $key = 'substituteHoliday:'.$substitutedHoliday->getKey();

        if ($date == $substitutedHoliday) {
            throw new \InvalidArgumentException('Date must differ from the substituted holiday');
        }

        // Construct instance
        parent::__construct($key, $names, $date, $displayLocale, $type);
    }

    /**
     * Returns the holiday being substituted.
     *
     * @return Holiday the holiday being substituted
     */
    public function getSubstitutedHoliday(): Holiday
    {
        return $this->substitutedHoliday;
    }

    /**
     * Returns the localized name of this holiday.
     *
     * The provided locales are searched for a translation. The first locale containing a translation will be used.
     *
     * If no locale is provided, proceed as if an array containing the display locale, Holiday::DEFAULT_LOCALE ('en_US'), and
     * Holiday::LOCALE_KEY (the holiday key) was provided.
     *
     * @param array<string>|null $locales The locales to search for translations
     *
     * @throws MissingTranslationException
     *
     * @see Holiday::DEFAULT_LOCALE
     * @see Holiday::LOCALE_KEY
     */
    public function getName(?array $locales = null): string
    {
        $name = parent::getName();

        if ($name !== $this->getKey()) {
            return $name;
        }

        foreach ($this->getLocales($locales) as $localeList) {
            $pattern = $this->substituteHolidayTranslations[$localeList] ?? null;
            if ($pattern) {
                return str_replace('{0}', $this->substitutedHoliday->getName(), $pattern);
            }
        }

        return $name;
    }

    /**
     * Merges local translations (preferred) with global translations.
     *
     * @param TranslationsInterface $globalTranslations global translations
     */
    public function mergeGlobalTranslations(TranslationsInterface $globalTranslations): void
    {
        $this->substituteHolidayTranslations = $globalTranslations->getTranslations('substituteHoliday');

        parent::mergeGlobalTranslations($globalTranslations);

        $this->substitutedHoliday->mergeGlobalTranslations($globalTranslations);
    }
}
