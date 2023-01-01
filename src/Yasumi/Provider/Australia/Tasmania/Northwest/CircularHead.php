<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Australia\Tasmania\Northwest;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania\Northwest;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Circular Head (Australia).
 */
class CircularHead extends Northwest
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    public const ID = 'AU-TAS-NW-CH';

    /**
     * Initialize holidays for Circular Head (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateAGFEST();
    }

    /**
     * AGFEST.
     *
     * @throws \Exception
     */
    private function calculateAGFEST(): void
    {
        $date = new \DateTime('first thursday of may '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $date = $date->add(new \DateInterval('P1D'));
        $this->addHoliday(new Holiday('agfest', ['en' => 'AGFEST'], $date, $this->locale));
    }
}
