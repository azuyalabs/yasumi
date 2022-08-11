<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Note: Any Islamic holidays are not part of this provider yet. Islamic holidays are quite complex and at first,
 * only other holidays are implemented.
 */
class Pakistan extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /** {@inheritdoc} */
    public const ID = 'PK';

    /**
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Karachi';

        // Add common holidays
        $this->addKashmirSolidarityDay();
        $this->addPakistanDay();
        $this->addLabourDay();
        $this->addIndependenceDay();
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
    }

    /** {@inheritdoc} */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Pakistan',
        ];
    }

    /**
     * @throws \Exception
     */
    private function addLabourDay(): void
    {
        $this->addHoliday(new Holiday('labourDay', [
            'en' => 'Labour Day',
        ], new \DateTime("$this->year-05-01", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Kashmir Day was first proposed in Pakistan in 1990..
     *
     * @see https://en.wikipedia.org/wiki/Kashmir_Solidarity_Day
     *
     * @throws \Exception
     */
    private function addKashmirSolidarityDay(): void
    {
        if (1990 > $this->year) {
            return;
        }

        $this->addHoliday(new Holiday('kashmirSolidarityDay', [
            'en' => 'Kashmir Solidarity Day',
        ], new \DateTime("$this->year-02-05", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Pakistan Day was first proposed in Pakistan in 1940.
     *
     * @see https://en.wikipedia.org/wiki/Pakistan_Day
     *
     * @throws \Exception
     */
    private function addPakistanDay(): void
    {
        if (1940 > $this->year) {
            return;
        }

        $this->addHoliday(new Holiday('pakistanDay', [
            'en' => 'Pakistan Day',
        ], new \DateTime("$this->year-03-23", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Independence Day, observed annually on 14 August, is a national holiday in Pakistan.
     *
     * @see https://en.wikipedia.org/wiki/Independence_Day_(Pakistan)
     *
     * @throws \Exception
     */
    private function addIndependenceDay(): void
    {
        if (1947 > $this->year) {
            return;
        }

        $this->addHoliday(new Holiday('independenceDay', [
            'en' => 'Independence Day',
        ], new \DateTime("$this->year-08-14", new \DateTimeZone($this->timezone)), $this->locale));
    }
}
