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

namespace Yasumi\Provider;

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

    public const EST_YEAR_DAY_OF_SOLIDARITY_WITH_ELDERLY = 2004;

    /**
     * Initialize holidays for France.
     *
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
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));

        if ($this->year >= 1919) {
            $this->addHoliday($this->armisticeDay($this->year, $this->timezone, $this->locale));
        }

        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateBastilleDay();
        $this->calculatePentecostMonday();
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
            ], new \DateTime("{$this->year}-7-14", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Pentecost Monday.
     *
     * Until 2004, Pentecost Monday was an official holiday. Since 2004, the holiday is considered a 'working holiday',
     * imposed by law to be by default on Pentecost Monday. Pentecost Monday is still a holiday (but a working holiday).
     *
     * @see: https://en.wikipedia.org/wiki/Journ%C3%A9e_de_solidarit%C3%A9_envers_les_personnes_%C3%A2g%C3%A9es
     *
     * @see: https://fr.wikipedia.org/w/index.php?title=Journ%C3%A9e_de_solidarit%C3%A9_envers_les_personnes_%C3%A2g%C3%A9es_et_handicap%C3%A9es&tableofcontents=0
     *
     * @throws \Exception
     */
    private function calculatePentecostMonday(): void
    {
        $type = Holiday::TYPE_OFFICIAL;

        if ($this->year >= 2004) {
            $type = Holiday::TYPE_OBSERVANCE;
        }

        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale, $type));
    }
}
