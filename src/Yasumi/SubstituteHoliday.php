<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;

/**
 * Class SubstituteHoliday.
 *
 * A substitute holiday is a holiday given in lieu of another holiday, if that day falls in a weekend or
 * overlaps with other holidays, so that people do not "lose" a day off in these years.
 *
 * @link https://en.wikipedia.org/wiki/Substitute_holiday
 */
class SubstituteHoliday extends Holiday
{
    /**
     * @var Holiday
     */
    public $substitutedHoliday;

    /**
     * @var array list of translations of the "{0} observed" pattern
     */
    public $substituteHolidayTranslations;

    /**
     * Creates a new SubstituteHoliday.
     *
     * If a holiday date needs to be defined for a specific timezone, make sure that the date instance
     * (DateTimeInterface) has the correct timezone set. Otherwise the default system timezone is used.
     *
     * @param Holiday $substitutedHoliday The holiday being substituted
     * @param array $names An array containing the name/description of this holiday
     *                                               in various languages. Overrides global translations
     * @param \DateTimeInterface $date A DateTimeInterface instance representing the date of the holiday
     * @param string $displayLocale Locale (i.e. language) in which the holiday information needs to
     *                                               be displayed in. (Default 'en_US')
     * @param string $type The type of holiday. Use the following constants: TYPE_OFFICIAL,
     *                                               TYPE_OBSERVANCE, TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default
     *                                               an official holiday is considered.
     *
     * @throws InvalidDateException
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

        $shortName = 'substituteHoliday:' . $substitutedHoliday->shortName;

        if ($date == $substitutedHoliday) {
            throw new \InvalidArgumentException('Date must differ from the substituted holiday');
        }

        // Construct instance
        parent::__construct($shortName, $names, $date, $displayLocale, $type);
    }

    /**
     * Returns the name of this holiday.
     *
     * The name of this holiday is returned translated in the given locale. If for the given locale no translation is
     * defined, the name in the default locale ('en_US') is returned. In case there is no translation at all, the short
     * internal name is returned.
     */
    public function getName(): string
    {
        $name = parent::getName();

        if ($name === $this->shortName) {
            $pattern = $this->substituteHolidayTranslations[$this->displayLocale]
                ?? $this->substituteHolidayTranslations[self::DEFAULT_LOCALE]
                ?? $this->shortName;

            $name = \str_replace('{0}', $this->substitutedHoliday->getName(), $pattern);
        }

        return $name;
    }

    /**
     * Merges local translations (preferred) with global translations.
     *
     * @param TranslationsInterface $globalTranslations global translations
     */
    public function mergeGlobalTranslations(TranslationsInterface $globalTranslations)
    {
        $this->substituteHolidayTranslations = $globalTranslations->getTranslations('substituteHoliday');

        parent::mergeGlobalTranslations($globalTranslations);

        $this->substitutedHoliday->mergeGlobalTranslations($globalTranslations);
    }
}
