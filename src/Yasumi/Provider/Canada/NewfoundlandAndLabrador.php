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

namespace Yasumi\Provider\Canada;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Canada;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in Newfoundland and Labrador (Canada).
 *
 * Manitoba is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/Newfoundland_and_Labrador
 */
class NewfoundlandAndLabrador extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-NL';

    /**
     * Initialize holidays for Newfoundland and Labrador (Canada).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/St_Johns';

        $this->calculateStPatricksDay();
        $this->calculateOrangemensDay();
        $this->addHoliday($this->stGeorgesDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * St. Patrick's Day.
     *
     * Saint Patrick's Day, or the Feast of Saint Patrick (Irish: Lá Fhéile Pádraig, "the Day of the Festival of
     * Patrick"), is a cultural and religious celebration held on 17 March, the traditional death date of Saint Patrick
     * (c. AD 385–461), the foremost patron saint of Ireland. Saint Patrick's Day is a public holiday in the Republic
     * of Ireland, Northern Ireland, the Canadian province of Newfoundland and Labrador, and the British Overseas
     * Territory of Montserrat.
     *
     * @see https://en.wikipedia.org/wiki/Saint_Patrick%27s_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     * @throws \Exception
     */
    private function calculateStPatricksDay(): void
    {
        if ($this->year < 1971) {
            return;
        }

        $holiday = new Holiday(
            'stPatricksDay',
            ['en' => 'St. Patrick’s Day'],
            new DateTime($this->year.'-3-17', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_BANK
        );

        $this->addHoliday($holiday);

        // Substitute holiday is on the next available weekday if a holiday falls on a Saturday or Sunday
        if (\in_array((int) $holiday->format('w'), [0, 6], true)) {
            $date = clone $holiday;
            $date->modify('next monday');

            $this->addHoliday(new SubstituteHoliday(
                $holiday,
                [],
                $date,
                $this->locale,
                Holiday::TYPE_BANK
            ));
        }
    }

    /**
     * Orangemen's Day.
     *
     * Orangemen's Day, also called The Twelfth or Glorious Twelfth) celebrates the Glorious Revolution (1688)
     * and victory of Protestant King William of Orange over Catholic king James II at the Battle of the
     * Boyne (1690), which began the Protestant Ascendancy in Ireland.
     *
     * @see https://en.wikipedia.org/wiki/The_Twelfth
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     * @throws \Exception
     */
    private function calculateOrangemensDay(): void
    {
        if ($this->year < 1926) {
            return;
        }

        $holiday = new Holiday(
            'orangemensDay',
            [],
            new DateTime($this->year.'-7-12', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_BANK
        );

        $this->addHoliday($holiday);

        // Substitute holiday is on the next available weekday if a holiday falls on a Saturday or Sunday
        if (\in_array((int) $holiday->format('w'), [0, 6], true)) {
            $date = clone $holiday;
            $date->modify('next monday');

            $this->addHoliday(new SubstituteHoliday(
                $holiday,
                [],
                $date,
                $this->locale,
                Holiday::TYPE_BANK
            ));
        }
    }
}
