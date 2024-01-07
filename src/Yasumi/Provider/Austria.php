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
 * Provider for all holidays in Austria.
 */
class Austria extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AT';

    /**
     * Initialize holidays for Austria.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Vienna';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add common Christian holidays (common in Austria)
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateNationalDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Austria',
            'https://de.wikipedia.org/wiki/Feiertage_in_%C3%96sterreich',
        ];
    }

    /**
     * Saint Leopold's Day.
     *
     * Saint Leopold III, known as Leopold the Good, was the Margrave of Austria
     * from 1095 to his death in 1136. He was a member of the House of
     * Babenberg. He was canonized on 6 January 1485 and became the patron saint
     * of Austria, Lower Austria, Upper Austria, and Vienna. His feast day is 15
     * November.
     *
     * @see https://en.wikipedia.org/wiki/Leopold_III,_Margrave_of_Austria
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateStLeopoldsDay(): void
    {
        if ($this->year < 1136) {
            return;
        }

        $this->addHoliday(new Holiday(
            'stLeopoldsDay',
            [],
            new \DateTime($this->year.'-11-15', new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * National Day.
     *
     * The Declaration of Neutrality was a declaration by the Austrian Parliament declaring the country permanently
     * neutral. It was enacted on 26 October 1955 as a constitutional act of parliament. Since 1955, neutrality has
     * become a deeply ingrained element of Austrian identity. Austria's national holiday on 26 October commemorates
     * the declaration.
     *
     * @see https://en.wikipedia.org/wiki/Declaration_of_Neutrality
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNationalDay(): void
    {
        if ($this->year < 1955) {
            return;
        }

        $this->addHoliday(new Holiday(
            'nationalDay',
            ['de' => 'Nationalfeiertag'],
            new \DateTime($this->year.'-10-26', new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
