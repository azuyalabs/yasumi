<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
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
 * Provider for all holidays in Indonesia.
 *
 * Indonesia observes a mix of national, Christian, Islamic, Hindu and
 * Buddhist holidays. Only the holidays that fall on a fixed date or can be
 * algorithmically determined (the Christian holidays, based on the date of
 * Easter) are included in this provider.
 *
 * Note: The holidays that follow the Islamic (Hijri), Balinese Saka and
 * Buddhist lunar calendars - Islamic New Year, Isra Mi'raj, Eid al-Fitr, Eid
 * al-Adha, the Prophet's Birthday, Nyepi (Balinese New Year), Vesak and
 * Chinese New Year - are not part of this provider yet. Their dates are
 * either based on the sighting of the moon or on complex lunar/lunisolar
 * calendar calculations, and are gazetted only shortly in advance, following
 * the same approach as the Turkey, Iran and Kenya providers.
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_Indonesia
 */
class Indonesia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166
     * code corresponding to the respective country or sub-region.
     */
    public const ID = 'ID';

    /**
     * Year in which New Year's Day and Independence Day were first observed
     * as national public holidays. This provider covers holidays from this
     * year onwards.
     */
    public const ESTABLISHMENT_YEAR = 1946;

    /**
     * Initialize holidays for Indonesia.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Jakarta';

        if ($this->year < self::ESTABLISHMENT_YEAR) {
            return;
        }

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add common Christian holidays
        $this->calculateGoodFriday();
        $this->calculateAscensionDay();

        // Calculate other holidays
        $this->calculateInternationalWorkersDay();
        $this->calculatePancasilaDay();
        $this->calculateIndependenceDay();
        $this->calculateChristmasDay();
    }

    /**
     * The source of the holidays.
     *
     * @return string[] The source URLs
     */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Indonesia',
        ];
    }

    /**
     * Good Friday.
     *
     * "Jumat Agung". Movable feast: the Friday before Easter Sunday. A
     * national public holiday between 1953 and 1962, and reinforced as such
     * since 1971.
     *
     * @throws \Exception
     */
    protected function calculateGoodFriday(): void
    {
        if ($this->year >= 1971) {
            $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        }
    }

    /**
     * Ascension Day.
     *
     * "Kenaikan Isa Almasih". Movable feast: the 39th day after Easter
     * Sunday. A national public holiday between 1953 and 1962, and
     * reinforced as such since 1968.
     *
     * @throws \Exception
     */
    protected function calculateAscensionDay(): void
    {
        if ($this->year >= 1968) {
            $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        }
    }

    /**
     * International Workers' Day.
     *
     * "Hari Buruh Internasional". A national public holiday between 1953 and
     * 1967, and reinforced as such since 2014.
     *
     * @throws \Exception
     */
    protected function calculateInternationalWorkersDay(): void
    {
        if ($this->year >= 2014) {
            $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        }
    }

    /**
     * Pancasila Day.
     *
     * "Hari Lahir Pancasila". Commemorates the day the Pancasila, the
     * philosophical foundation of the Indonesian state, was first outlined
     * by Sukarno on 1 June 1945. Declared a national public holiday by
     * Presidential Decree No. 24 of 2016, first observed in 2017.
     *
     * @see https://en.wikipedia.org/wiki/Pancasila_Day
     *
     * @throws \Exception
     */
    protected function calculatePancasilaDay(): void
    {
        if ($this->year >= 2017) {
            $this->addHoliday(new Holiday(
                'pancasilaDay',
                [],
                new \DateTime("{$this->year}-06-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Independence Day.
     *
     * "Hari Kemerdekaan Republik Indonesia". Commemorates the proclamation
     * of Indonesian independence by Sukarno on 17 August 1945. A national
     * public holiday since 1946.
     *
     * @see https://en.wikipedia.org/wiki/Indonesian_Declaration_of_Independence
     *
     * @throws \Exception
     */
    protected function calculateIndependenceDay(): void
    {
        $this->addHoliday(new Holiday(
            'independenceDay',
            [],
            new \DateTime("{$this->year}-08-17", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Christmas Day.
     *
     * "Hari Raya Natal". Fixed date: 25 December. A national public holiday
     * since 1953.
     *
     * @throws \Exception
     */
    protected function calculateChristmasDay(): void
    {
        if ($this->year >= 1953) {
            $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        }
    }
}
