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

namespace Yasumi\Provider\Australia\Tasmania\Northwest;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\Australia\Tasmania\Northwest;

/**
 * Provider for all holidays in Circular Head (Australia).
 *
 */
class CircularHead extends Northwest
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    const ID = 'AU-TAS-NW-CH';

    public $timezone = 'Australia/Tasmania';

    /**
     * Initialize holidays for Circular Head (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->calculateAGFEST();
    }
    
    public function calculateAGFEST()
    {
        $date = new DateTime('first thursday of may ' . $this->year, new DateTimeZone($this->timezone));
        $date = $date->add(new DateInterval('P1D'));
        $this->addHoliday(new Holiday('agfest', ['en_AU' => 'AGFEST'], $date, $this->locale));
    }
}
