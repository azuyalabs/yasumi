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

namespace Yasumi\Provider\Australia\Tasmania;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania;

/**
 * Provider for all holidays in northwestern Tasmania (Australia).
 *
 */
class Northwest extends Tasmania
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    public const ID = 'AU-TAS-NW';

    /**
     * Initialize holidays for northwestern Tasmania (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateBurnieShow();
    }

    /**
     * Burnie Show
     *
     * @throws \Exception
     */
    private function calculateBurnieShow(): void
    {
        $date = new DateTime('first saturday of october ' . $this->year, new DateTimeZone($this->timezone));
        $date = $date->sub(new DateInterval('P1D'));
        $this->addHoliday(new Holiday('burnieShow', ['en' => 'Burnie Show'], $date, $this->locale));
    }
}
