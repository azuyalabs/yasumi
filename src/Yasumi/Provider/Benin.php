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
 * Provider for all holidays in Benin.
 *
 * Benin's legal holidays are fixed by Law 90-019 of 27 July 1990, which declares them
 * days off and paid (article 2). The same law designates three National Days that are
 * commemorated without a day off (article 3). The annual traditional religions festival
 * was added by Law 97-031 of 20 August 1997 and moved by Law 2024-32 of 2 September 2024.
 * Benin has no rule moving a holiday that falls on a weekend.
 *
 * Note: The Islamic holidays Jour du Ramadan (Eid al-Fitr), Jour de la Tabaski (Eid al-Adha)
 * and Journée Maouloud (Prophet's Birthday) are legal holidays under Law 90-019, but they are
 * not part of this provider yet. Their dates depend on the sighting of the moon and are
 * announced by the government only shortly in advance. Islamic holidays are quite complex
 * and at first, an Islamic calendar provider needs to be in place.
 *
 * @see https://sgg.gouv.bj/doc/loi-90-019/
 * @see https://sgg.gouv.bj/doc/loi-2024-32/
 */
class Benin extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166
     * code corresponding to the respective country or sub-region.
     */
    public const ID = 'BJ';

    /**
     * First full year under Law 90-019 of 27 July 1990, which fixes the current
     * legal holidays. This provider covers holidays from this year onwards.
     */
    public const ESTABLISHMENT_YEAR = 1991;

    /**
     * Initialize holidays for Benin.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Africa/Porto-Novo';

        if ($this->year < self::ESTABLISHMENT_YEAR) {
            return;
        }

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWomensDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Add common Christian holidays
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateTraditionalReligionsDay();
        $this->calculateRemembranceDay();
        $this->calculatePeoplesSovereigntyDay();
        $this->calculateNationalDay();
    }

    /**
     * The source of the holidays.
     *
     * @return string[] The source URLs
     */
    public function getSources(): array
    {
        return [
            'https://sgg.gouv.bj/doc/loi-90-019/',
            'https://sgg.gouv.bj/doc/loi-97-031/',
            'https://sgg.gouv.bj/doc/loi-2024-32/',
            'https://en.wikipedia.org/wiki/Public_holidays_in_Benin',
        ];
    }

    /**
     * Annual traditional religions festival (Vodoun Festival).
     *
     * Instituted by Law 97-031 of 20 August 1997 and celebrated on 10 January. Since 2025,
     * Law 2024-32 of 2 September 2024 sets it on the second Friday of January and makes
     * both that Friday and the Thursday before it days off.
     *
     * @see https://sgg.gouv.bj/doc/loi-97-031/
     * @see https://sgg.gouv.bj/doc/loi-2024-32/
     *
     * @throws \Exception
     */
    protected function calculateTraditionalReligionsDay(): void
    {
        if ($this->year < 1998) {
            return;
        }

        $names = ['en' => 'Vodoun Festival', 'fr' => 'Fête annuelle des religions traditionnelles'];
        $timezone = DateTimeZoneFactory::getDateTimeZone($this->timezone);

        if ($this->year < 2025) {
            $this->addHoliday(new Holiday(
                'traditionalReligionsDay',
                $names,
                new \DateTime("{$this->year}-01-10", $timezone),
                $this->locale
            ));

            return;
        }

        $secondFriday = new \DateTime("second friday of january {$this->year}", $timezone);

        $this->addHoliday(new Holiday('traditionalReligionsDay', $names, $secondFriday, $this->locale));
        $this->addHoliday(new Holiday(
            'traditionalReligionsDayEve',
            $names,
            (clone $secondFriday)->modify('-1 day'),
            $this->locale
        ));
    }

    /**
     * Remembrance Day.
     *
     * "Journée de Souvenir". A National Day under article 3 of Law 90-019, commemorated
     * on 16 January without a day off.
     *
     * @throws \Exception
     */
    protected function calculateRemembranceDay(): void
    {
        $this->addHoliday(new Holiday(
            'remembranceDay',
            ['en' => 'Remembrance Day', 'fr' => 'Journée de Souvenir'],
            new \DateTime("{$this->year}-01-16", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }

    /**
     * People's Sovereignty Day.
     *
     * "Journée de la Souveraineté du Peuple". A National Day under article 3 of
     * Law 90-019, commemorated on 28 February without a day off.
     *
     * @throws \Exception
     */
    protected function calculatePeoplesSovereigntyDay(): void
    {
        $this->addHoliday(new Holiday(
            'peoplesSovereigntyDay',
            ['en' => 'People’s Sovereignty Day', 'fr' => 'Journée de la Souveraineté du Peuple'],
            new \DateTime("{$this->year}-02-28", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }

    /**
     * National Day.
     *
     * "Fête Nationale". Celebrates the independence of Benin (then Dahomey)
     * on 1 August 1960.
     *
     * @throws \Exception
     */
    protected function calculateNationalDay(): void
    {
        $this->addHoliday(new Holiday(
            'nationalDay',
            ['en' => 'National Day', 'fr' => 'Fête Nationale'],
            new \DateTime("{$this->year}-08-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
