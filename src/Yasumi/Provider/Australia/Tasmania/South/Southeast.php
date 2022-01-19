<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Australia\Tasmania\South;

use DateTime;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania\South;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in southeastern Tasmania (Australia).
 */
class Southeast extends South
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    public const ID = 'AU-TAS-SOU-SE';

    public string $timezone = 'Australia/Hobart';

    /**
     * Initialize holidays for southeastern Tasmania (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->removeHoliday('recreationDay');
        $this->calculateHobartRegatta();
    }

    /**
     * Royal Hobart Regatta.
     *
     * @throws \Exception
     */
    private function calculateHobartRegatta(): void
    {
        $this->addHoliday(new Holiday(
            'hobartRegatta',
            ['en' => 'Royal Hobart Regatta'],
            new DateTime('second monday of february '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }
}
