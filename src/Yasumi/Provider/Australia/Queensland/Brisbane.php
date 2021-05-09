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

namespace Yasumi\Provider\Australia\Queensland;

use DateInterval;
use DateTime;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Queensland;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Brisbane (Australia).
 */
class Brisbane extends Queensland
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there isn't one specifically for Brisbane,
     * and I believe this is a logical extension.
     */
    public const ID = 'AU-QLD-BRI';

    public $timezone = 'Australia/Brisbane';

    /**
     * Initialize holidays for Brisbane (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculatePeoplesDay();
    }

    /**
     * Ekka People's Day.
     *
     * The Ekka is the annual agricultural show of Queensland, Australia. Its formal title is the Royal Queensland Show
     * and it is held at the Brisbane Showgrounds. It was originally called the Brisbane Exhibition, however it is more
     * commonly known as the Ekka, which is a shortening of the word exhibition. It is run by The Royal National
     * Agricultural and Industrial Association of Queensland.
     * Because of the cultural significance of the Ekka, the City of Brisbane holds a Wednesday public holiday known as
     * "People's Day". The Ekka starts on the first Friday in August, except if the first Friday is before 5 August, in
     * which case it starts on the second Friday of August. People's Day is then the Wednesday after the Ekka commences.
     *
     * @see https://en.wikipedia.org/wiki/Ekka
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculatePeoplesDay(): void
    {
        $date = new DateTime('first friday of august '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone));
        if ($date->format('d') < 5) {
            $date = $date->add(new DateInterval('P7D'));
        }
        $date = $date->add(new DateInterval('P5D'));
        $this->addHoliday(new Holiday('peoplesDay', ['en' => 'Ekka People’s Day'], $date, $this->locale));
    }
}
