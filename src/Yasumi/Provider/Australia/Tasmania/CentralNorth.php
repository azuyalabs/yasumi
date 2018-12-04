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

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania;

/**
 * Provider for all holidays in central north Tasmania (Australia).
 *
 */
class CentralNorth extends Tasmania
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    const ID = 'AU-TAS-CN';

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

        $this->calculateDevonportShow();
    }

    /**
     * Devonport Show
     *
     * @throws \Exception
     */
    public function calculateDevonportShow()
    {
        $date = new DateTime($this->year . '-12-02', new DateTimeZone($this->timezone));
        $date = $date->modify('previous friday');
        $this->addHoliday(new Holiday('devonportShow', ['en_AU' => 'Devonport Show'], $date, $this->locale));
    }
}
