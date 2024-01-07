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

namespace Yasumi\Provider\Australia;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Western Australia (Australia).
 */
class WesternAustralia extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-WA';

    public string $timezone = 'Australia/West';

    /**
     * Initialize holidays for Western Australia (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateQueensBirthday();
        $this->calculateLabourDay();
        $this->calculateWesternAustraliaDay();
    }

    /**
     * Queens Birthday.
     *
     * The Queen's Birthday is an Australian public holiday but the date varies across
     * states and territories. Australia celebrates this holiday because it is a constitutional
     * monarchy, with the English monarch as head of state.
     *
     * Her actual birthday is on April 21, but it's celebrated as a public holiday on the second Monday of June.
     *  (Except QLD & WA)
     *
     * @see https://www.timeanddate.com/holidays/australia/queens-birthday
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateQueensBirthday(): void
    {
        $birthDay = 'last monday of september '.$this->year;
        if (2011 === $this->year) {
            $birthDay = '2011-10-28';
        }

        if (2012 === $this->year) {
            $birthDay = '2012-10-01';
        }

        $this->addHoliday(new Holiday(
            'queensBirthday',
            [],
            new \DateTime($birthDay, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }

    /**
     * Labour Day.
     *
     * @throws \Exception
     */
    private function calculateLabourDay(): void
    {
        $date = new \DateTime("first monday of march {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }

    /**
     * Western Australia Day.
     *
     * @see https://en.wikipedia.org/wiki/Western_Australia_Day
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateWesternAustraliaDay(): void
    {
        $this->addHoliday(new Holiday(
            'westernAustraliaDay',
            ['en' => 'Western Australia Day'],
            new \DateTime('first monday of june '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }
}
