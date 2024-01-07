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

namespace Yasumi\Provider\UnitedKingdom;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\UnitedKingdom;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in Northern Ireland (United Kingdom).
 *
 * Northern Ireland is a country that is part of the United Kingdom. It covers an area of 14,130 square kilometres
 * (5,460 sq mi), and has a population of 1,885,400. Belfast, Northern Ireland's capital and largest city,
 * is the 12th largest city in the United Kingdom.
 *
 * @see https://en.wikipedia.org/wiki/Northern_Ireland
 */
class NorthernIreland extends UnitedKingdom
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'GB-NIR';

    /**
     * Initialize holidays for Northern Ireland (United Kingdom).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateStPatricksDay();
        $this->calculateBattleOfTheBoyne();
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
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
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
            new \DateTime($this->year.'-3-17', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
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
     * Battle of the Boyne.
     *
     * Orangemen's Day, also called The Twelfth or Glorious Twelfth) celebrates the Glorious Revolution (1688)
     * and victory of Protestant King William of Orange over Catholic king James II at the Battle of the
     * Boyne (1690), which began the Protestant Ascendancy in Ireland.
     *
     * @see https://en.wikipedia.org/wiki/The_Twelfth
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateBattleOfTheBoyne(): void
    {
        if ($this->year < 1926) {
            return;
        }

        $holiday = new Holiday(
            'battleOfTheBoyne',
            ['en' => 'Battle of the Boyne'],
            new \DateTime($this->year.'-7-12', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
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
