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
 * Provider for all holidays in northeastern Tasmania (Australia).
 */
class Northeast extends Tasmania
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    public const ID = 'AU-TAS-NE';

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

        $this->calculateLauncestonShow();
    }

    /**
     * Royal Launceston Show.
     *
     * @throws \Exception
     */
    private function calculateLauncestonShow(): void
    {
        $date = new \DateTime('second saturday of october '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $date = $date->sub(new \DateInterval('P2D'));
        $this->addHoliday(new Holiday('launcestonShow', ['en' => 'Royal Launceston Show'], $date, $this->locale));
    }
}
