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

namespace Yasumi\Provider\Germany;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Berlin (Germany).
 *
 * Berlin is the capital of Germany and one of its 16 states. With a population of approximately 3.5 million people,
 * Berlin is the second most populous city proper and the seventh most populous urban area in the European Union.
 * Located in northeastern Germany on the banks of Rivers Spree and Havel, it is the centre of the Berlin-Brandenburg
 * Metropolitan Region, which has about six million residents from over 180 nations.
 *
 * @see https://en.wikipedia.org/wiki/Berlin
 */
class Berlin extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-BE';

    /**
     * Initialize holidays for Berlin (Germany).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        if ($this->year >= 2019) {
            $this->addHoliday($this->internationalWomensDay($this->year, $this->timezone, $this->locale));
        }

        if (2020 === $this->year) {
            $this->addHoliday($this->dayOfLiberation($this->timezone, $this->locale));
        }
    }

    /**
     * Day of Liberation.
     *
     * Day of Liberation (Tag der Befreiung) is celebrated on May 8 2020 to commemorate the 75th anniversary
     * of the German Instrument of Surrender.
     *
     * @see https://de.wikipedia.org/wiki/Tag_der_Befreiung
     *
     * @param string $timezone the timezone in which Day of Liberation is celebrated
     * @param string $locale   the locale for which Day of Liberation needs to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function dayOfLiberation(
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'dayOfLiberation',
            [],
            new DateTime('2020-05-08', DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }
}
