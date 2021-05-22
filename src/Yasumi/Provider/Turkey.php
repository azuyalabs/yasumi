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

namespace Yasumi\Provider;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

class Turkey extends AbstractProvider
{
    use CommonHolidays;

    /** {@inheritdoc} */
    public const ID = 'TR';

    /**
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Istanbul';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addNationalSovereigntyDay();
        $this->addLabourDay();
        $this->addCommemorationOfAtaturk();
    }

    /** {@inheritdoc} */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Turkey',
            'https://tr.wikipedia.org/wiki/T%C3%BCrkiye%27deki_resm%C3%AE_tatiller',
        ];
    }

    /**
     * @throws \Exception
     */
    private function addLabourDay(): void
    {
        $this->addHoliday(new Holiday('labourDay', [
            'tr' => 'Emek ve Dayanışma Günü',
        ], new \DateTime("$this->year-05-01", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Commemoration of the first opening of the Grand National Assembly of Turkey at Ankara in 1920.
     * Dedicated to the children.
     *
     * Not sure if 1920 is the first year of celebration as above source mentions Law No. 3466 that "May 19" was
     * made official June 20, 1938.
     *
     * @see https://en.wikipedia.org/wiki/Commemoration_of_Atat%C3%BCrk,_Youth_and_Sports_Day
     *
     * @throws \Exception
     */
    private function addCommemorationOfAtaturk(): void
    {
        if (1920 > $this->year) {
            return;
        }

        $this->addHoliday(new Holiday('commemorationAtaturk', [
            'tr' => 'Atatürk’ü Anma, Gençlik ve Spor Bayramı',
        ], new \DateTime("$this->year-05-19", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * National Sovereignty and Children's Day (Turkish: Ulusal Egemenlik ve Çocuk Bayramı) is a public holiday in
     * Turkey commemorating the foundation of the Grand National Assembly of Turkey, on 23 April 1920.
     * Since 1927, the holiday has also been celebrated as a children's day.
     *
     * @see https://en.wikipedia.org/wiki/National_Sovereignty_and_Children%27s_Day
     *
     * @throws \Exception
     */
    private function addNationalSovereigntyDay(): void
    {
        if (1922 > $this->year) {
            return;
        }

        $holidayName = 'Ulusal Egemenlik Bayramı';

        // In 1981 this day was officially named 'Ulusal Egemenlik ve Çocuk Bayramı'
        if (1981 <= $this->year) {
            $holidayName = 'Ulusal Egemenlik ve Çocuk Bayramı';
        }

        $this->addHoliday(new Holiday('nationalSovereigntyDay', [
            'tr' => $holidayName,
        ], new \DateTime("$this->year-04-23", new \DateTimeZone($this->timezone)), $this->locale));
    }
}
