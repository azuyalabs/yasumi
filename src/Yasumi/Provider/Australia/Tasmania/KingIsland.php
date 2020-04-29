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

use DateTime;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in King Island (Australia).
 *
 */
class KingIsland extends Tasmania
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    public const ID = 'AU-TAS-KI';

    /**
     * Initialize holidays for King Island (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->calculateKingIslandShow();
    }

    /**
     * King Island Show
     *
     * @throws \Exception
     */
    private function calculateKingIslandShow(): void
    {
        $this->addHoliday(new Holiday(
            'kingIslandShow',
            ['en' => 'King Island Show'],
            new DateTime('first tuesday of march ' . $this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }
}
