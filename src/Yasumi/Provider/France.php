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

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in France.
 */
class France extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'FR';

    /**
     * Initialize holidays for France.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Paris';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        if ($this->year >= 1945) {
            $this->addHoliday($this->victoryInEuropeDay($this->year, $this->timezone, $this->locale));
        }

        // Add Christian holidays
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));

        if ($this->year >= 1919) {
            $this->addHoliday($this->armisticeDay($this->year, $this->timezone, $this->locale));
        }

        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateBastilleDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_France',
            'https://fr.wikipedia.org/wiki/F%C3%AAtes_et_jours_f%C3%A9ri%C3%A9s_en_France',
        ];
    }

    /**
     * French National Day.
     *
     * The French National Day commemorates the beginning of the French Revolution with the Storming of the Bastille
     * on 14 July 1789,as well as the Fête de la Fédération which celebrated the unity of the French people on 14
     * July 1790. Celebrations are held throughout France. The oldest and largest regular military parade in Europe
     * is held on the morning of 14 July, on the Champs-Élysées in Paris in front of the President of the Republic,
     * French officials and foreign guests.
     *
     * @see https://en.wikipedia.org/wiki/Bastille_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateBastilleDay(): void
    {
        if ($this->year >= 1790) {
            $this->addHoliday(new Holiday('bastilleDay', [
                'en' => 'Bastille Day',
                'fr' => 'La Fête nationale',
            ], new DateTime("$this->year-7-14", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }
}
