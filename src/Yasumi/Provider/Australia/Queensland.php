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

namespace Yasumi\Provider\Australia;

use DateTime;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Queensland (Australia).
 */
class Queensland extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-QLD';

    public string $timezone = 'Australia/Queensland';

    /**
     * Initialize holidays for Queensland (Australia).
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
        $birthDay = 'first monday of october '.$this->year;

        if ($this->year < 2012 || 2013 === $this->year || 2014 === $this->year || 2015 === $this->year) {
            $birthDay = 'second monday of june '.$this->year;
        }

        $this->addHoliday(new Holiday(
            'queensBirthday',
            [],
            new DateTime($birthDay, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
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
        $date = new DateTime("first monday of may $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        if (2013 === $this->year || 2014 === $this->year || 2015 === $this->year) {
            $date = new DateTime("first monday of october $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        }

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }
}
