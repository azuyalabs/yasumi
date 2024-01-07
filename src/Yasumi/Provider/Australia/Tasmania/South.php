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

namespace Yasumi\Provider\Australia\Tasmania;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in southern Tasmania (Australia).
 */
class South extends Tasmania
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    public const ID = 'AU-TAS-SOU';

    /**
     * Initialize holidays for southern Tasmania (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateHobartShow();
    }

    /**
     * Royal Hobart Show.
     *
     * @throws \Exception
     */
    private function calculateHobartShow(): void
    {
        $date = new \DateTime('fourth saturday of october '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $date = $date->sub(new \DateInterval('P2D'));
        $this->addHoliday(new Holiday('hobartShow', ['en' => 'Royal Hobart Show'], $date, $this->locale));
    }
}
