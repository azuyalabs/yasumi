<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author William Sanders <williamrsanders@hotmail.com>
 */

namespace Yasumi\Provider\Australia\Tasmania;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania;

/**
 * Provider for all holidays in northeastern Tasmania (Australia).
 *
 */
class Northeast extends Tasmania
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    const ID = 'AU-TAS-NE';

    public $timezone = 'Australia/Tasmania';

    /**
     * Initialize holidays for northeastern Tasmania (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->calculateLauncestonShow();
    }
    
    public function calculateLauncestonShow()
    {
        $date = new DateTime('second saturday of october ' . $this->year, new DateTimeZone($this->timezone));
        $date = $date->sub(new DateInterval('P2D'));
        $this->addHoliday(new Holiday('launcestonShow', ['en_AU' => 'Royal Launceston Show'], $date, $this->locale));
    }
}
