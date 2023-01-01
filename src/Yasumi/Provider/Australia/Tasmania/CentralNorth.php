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

namespace Yasumi\Provider\Australia\Tasmania;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in central north Tasmania (Australia).
 */
class CentralNorth extends Tasmania
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    public const ID = 'AU-TAS-CN';

    /**
     * Initialize holidays for northeastern Tasmania (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateDevonportShow();
    }

    /**
     * Devonport Show.
     *
     * @throws \Exception
     */
    private function calculateDevonportShow(): void
    {
        $date = new \DateTime($this->year.'-12-02', DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $date = $date->modify('previous friday');

        $this->addHoliday(new Holiday('devonportShow', ['en' => 'Devonport Show'], $date, $this->locale));
    }
}
