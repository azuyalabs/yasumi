<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Germany.
 */
class Germany extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE';

    /**
     * Initialize holidays for Germany.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Berlin';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->newYearsEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        // Add common Christian holidays (common in Germany)
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateGermanUnityDay();

        // Note: all German states have agreed this to be a nationwide holiday in 2017 to celebrate the 500th anniversary.
        if (2017 === $this->year) {
            $this->addHoliday($this->reformationDay($this->year, $this->timezone, $this->locale));
        }
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Germany',
            'https://de.wikipedia.org/wiki/Gesetzliche_Feiertage_in_Deutschland',
        ];
    }

    /**
     * German Unity Day.
     *
     * The Day of German Unity (German: Tag der Deutschen Einheit) is the national day of Germany, celebrated on
     * 3 October as a public holiday. It commemorates the anniversary of German reunification in 1990, when the
     * goal of a united Germany that originated in the middle of the 19th century, was fulfilled again. Therefore,
     * the name addresses neither the re-union nor the union, but the unity of Germany. The Day of German Unity on
     * 3 October has been the German national holiday since 1990, when the reunification was formally completed. It
     * is a legal holiday for the Federal Republic of Germany.
     *
     * @see https://en.wikipedia.org/wiki/German_Unity_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateGermanUnityDay(): void
    {
        if ($this->year >= 1990) {
            $this->addHoliday(new Holiday(
                'germanUnityDay',
                ['de' => 'Tag der Deutschen Einheit'],
                new \DateTime($this->year.'-10-3', new \DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
