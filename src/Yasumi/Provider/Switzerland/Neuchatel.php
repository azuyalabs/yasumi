<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider\Switzerland;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Switzerland;

/**
 * Provider for all holidays in Neuchâtel (Switzerland).
 *
 * @link https://en.wikipedia.org/wiki/Canton_of_Neuch%C3%A2tel
 */
class Neuchatel extends Switzerland
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CH-NE';

    /**
     * Initialize holidays for Neuchâtel (Switzerland).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->internationalWorkersDay(
            $this->year,
            $this->timezone,
            $this->locale,
            Holiday::TYPE_OTHER
        ));
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        $this->calculateBerchtoldsTag();
        $this->calculateBettagsMontag();
        $this->calculateInstaurationRepublique();
    }

    /**
     * Instauration de la République
     *
     * @link https://www.feiertagskalender.ch/feiertag.php?ft_id=11&geo=3056&hl=fr
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateInstaurationRepublique(): void
    {
        if ($this->year > 1848) {
            $this->addHoliday(new Holiday(
                'instaurationRepublique',
                [
                    'fr' => 'Instauration de la République',
                ],
                new DateTime($this->year . '-03-01', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OTHER
            ));
        }
    }
}
