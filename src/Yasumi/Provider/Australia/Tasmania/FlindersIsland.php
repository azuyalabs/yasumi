<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider\Australia\Tasmania;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania;

/**
 * Provider for all holidays in Flinders Island (Australia).
 *
 */
class FlindersIsland extends Tasmania
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    public const ID = 'AU-TAS-FI';

    /**
     * Initialize holidays for Flinders Island (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateFlindersIslandShow();
    }

    /**
     * Flinders Island Show
     *
     * @throws \Exception
     */
    private function calculateFlindersIslandShow(): void
    {
        $date = new DateTime('third saturday of october ' . $this->year, new DateTimeZone($this->timezone));
        $date = $date->sub(new DateInterval('P1D'));
        $this->addHoliday(new Holiday('flindersIslandShow', ['en_AU' => 'Flinders Island Show'], $date, $this->locale));
    }
}
