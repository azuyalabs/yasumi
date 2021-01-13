<?php
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

declare(strict_types=1);

namespace Yasumi\Provider;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Luxembourg.
 */
class Luxembourg extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    public const EUROPE_DAY_START_YEAR = 2019;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'LU';

    /**
     * Initialize holidays for Luxembourg.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Luxembourg';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->calculateEuropeDay();
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->calculateNationalDay();
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * Europe Day.
     *
     * Europe Day is celebrated on 5 May by the Council of Europe and on 9 May by the European Union.
     * The first recognition of Europe Day was by the Council of Europe, introduced in 1964.
     * The European Union later started to celebrate its own European Day in commemoration of the 1950
     * Schuman Declaration, leading it to be referred to by some as "Schuman Day".
     * Both days are celebrated by displaying the Flag of Europe.
     *
     * @see https://en.wikipedia.org/wiki/Europe_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function calculateEuropeDay(): void
    {
        if ($this->year >= 2019) {
            $this->addHoliday(new Holiday('europeDay', [
                'en_US' => 'Europe day',
                'fr' => 'La Journée de l’Europe',
            ], new DateTime("$this->year-5-9", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Luxembourgish National Day.
     *
     * The Grand Duke's Official Birthday (French: Célébration publique de l'anniversaire du souverain),
     * also known as Luxembourgish National Day (French: Fête nationale luxembourgeoise, Luxembourgish:
     * Lëtzebuerger Nationalfeierdag), is celebrated as the annual national holiday of Luxembourg.
     * It is celebrated on 23 June, although this has never been the actual birthday of any ruler of Luxembourg.
     * When the monarch of Luxembourg is female, it is known as the Grand Duchess' Official Birthday.
     *
     * @see https://en.wikipedia.org/wiki/Grand_Duke%27s_Official_Birthday
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function calculateNationalDay(): void
    {
        $this->addHoliday(new Holiday('nationalDay', [
            'en_US' => 'National day',
            'fr' => 'La Fête nationale',
        ], new DateTime("$this->year-6-23", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }
}
