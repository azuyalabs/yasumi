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
 * Provider for all holidays in San Marino.
 *
 * San Marino observes 18 national public holidays. The official language is Italian (it_SM).
 * The Most Serene Republic of San Marino is one of the world's oldest republics, traditionally
 * founded on 3 September 301 AD by Saint Marinus of Rab.
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_San_Marino
 */
class SanMarino extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * The year the Arengo (popular assembly) was reconvened, establishing democratic rights.
     */
    public const ARENGO_YEAR = 1906;

    /**
     * The year the Fall of Fascism holiday was first observed.
     */
    public const FALL_OF_FASCISM_YEAR = 1944;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'SM';

    /**
     * Initialize holidays for San Marino.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/San_Marino';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale));

        // Add San Marino-specific holidays
        $this->calculateFeastOfSaintAgatha();
        $this->calculateAnniversaryOfArengo();
        $this->calculateInvestitureCaptainsRegentApril();
        $this->calculateFallOfFascism();
        $this->calculateFoundationDay();
        $this->calculateInvestitureCaptainsRegentOctober();
        $this->calculateCommemorationOfTheFallen();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_San_Marino',
            'https://it.wikipedia.org/wiki/Festivit%C3%A0_di_San_Marino',
        ];
    }

    /**
     * Feast of Saint Agatha.
     *
     * The Feast of Saint Agatha (Italian: Festa di Sant'Agata) is celebrated on 5 February. Saint Agatha is the
     * patron saint of San Marino. The day also commemorates the anniversary of the liberation of San Marino from
     * the occupation by Cardinal Giulio Alberoni on 5 February 1740.
     *
     * @see https://en.wikipedia.org/wiki/Saint_Agatha
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateFeastOfSaintAgatha(): void
    {
        $this->addHoliday(new Holiday(
            'feastOfSaintAgatha',
            [
                'it' => "Festa di Sant\u{2019}Agata",
                'en' => 'Feast of Saint Agatha',
            ],
            new \DateTime("{$this->year}-2-5", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Anniversary of the Arengo.
     *
     * The Anniversary of the Arengo (Italian: Anniversario dell'Arengo) is celebrated on 25 March. The Arengo is
     * the ancient popular assembly of San Marino. On 25 March 1906, the Arengo was reconvened after centuries,
     * granting democratic rights including universal suffrage, marking a pivotal moment in San Marino's history.
     *
     * @see https://en.wikipedia.org/wiki/Arengo_(San_Marino)
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateAnniversaryOfArengo(): void
    {
        if ($this->year >= self::ARENGO_YEAR) {
            $this->addHoliday(new Holiday(
                'anniversaryOfArengo',
                [
                    'it' => "Anniversario dell\u{2019}Arengo",
                    'en' => 'Anniversary of the Arengo',
                ],
                new \DateTime("{$this->year}-3-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Investiture of the Captains Regent (April).
     *
     * The Investiture of the Captains Regent (Italian: Investitura dei Capitani Reggenti) on 1 April marks the
     * formal investiture ceremony of the two newly elected Captains Regent who serve as heads of state. The
     * Captains Regent are elected twice yearly and serve a six-month term. This ceremony has been observed since
     * the 13th century.
     *
     * @see https://en.wikipedia.org/wiki/Captain_Regent
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateInvestitureCaptainsRegentApril(): void
    {
        $this->addHoliday(new Holiday(
            'investitureCaptainsRegentApril',
            [
                'it' => 'Investitura dei Capitani Reggenti',
                'en' => 'Investiture of the Captains Regent',
            ],
            new \DateTime("{$this->year}-4-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Fall of Fascism.
     *
     * The Fall of Fascism (Italian: Caduta del Fascismo) is observed on 28 July, commemorating the coup d'état of
     * 28 July 1943 when San Marino's Great and General Council voted to overthrow the Fascist government, ending
     * the Fascist regime in the republic. The holiday has been observed since 1944.
     *
     * @see https://en.wikipedia.org/wiki/San_Marino_in_World_War_II
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateFallOfFascism(): void
    {
        if ($this->year >= self::FALL_OF_FASCISM_YEAR) {
            $this->addHoliday(new Holiday(
                'fallOfFascism',
                [
                    'it' => 'Caduta del Fascismo',
                    'en' => 'Fall of Fascism',
                ],
                new \DateTime("{$this->year}-7-28", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Foundation Day (San Marino Day).
     *
     * Foundation Day (Italian: Anniversario della Fondazione della Repubblica), observed on 3 September,
     * commemorates the traditional founding of the Republic of San Marino on 3 September 301 AD by Saint Marinus
     * of Rab, a Christian stonemason from the island of Rab. It is also known as San Marino Day.
     *
     * @see https://en.wikipedia.org/wiki/San_Marino
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateFoundationDay(): void
    {
        $this->addHoliday(new Holiday(
            'foundationDay',
            [
                'it' => 'Anniversario della Fondazione della Repubblica',
                'en' => 'Foundation Day',
            ],
            new \DateTime("{$this->year}-9-3", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Investiture of the Captains Regent (October).
     *
     * The Investiture of the Captains Regent (Italian: Investitura dei Capitani Reggenti) on 1 October marks the
     * formal investiture ceremony of the two newly elected Captains Regent. The ceremony is held twice yearly,
     * on 1 April and 1 October.
     *
     * @see https://en.wikipedia.org/wiki/Captain_Regent
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateInvestitureCaptainsRegentOctober(): void
    {
        $this->addHoliday(new Holiday(
            'investitureCaptainsRegentOctober',
            [
                'it' => 'Investitura dei Capitani Reggenti',
                'en' => 'Investiture of the Captains Regent',
            ],
            new \DateTime("{$this->year}-10-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Commemoration of the Fallen.
     *
     * The Commemoration of the Fallen (Italian: Commemorazione dei Defunti), observed on 2 November, is a day
     * to honour and remember all deceased persons. It coincides with All Souls' Day in the Catholic tradition
     * and is an official public holiday in San Marino.
     *
     * @see https://en.wikipedia.org/wiki/All_Souls%27_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateCommemorationOfTheFallen(): void
    {
        $this->addHoliday(new Holiday(
            'commemorationOfTheFallen',
            [
                'it' => 'Commemorazione dei Defunti',
                'en' => 'Commemoration of the Fallen',
            ],
            new \DateTime("{$this->year}-11-2", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
