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

namespace Yasumi\Provider\Australia\Tasmania\South;

use DateTime;
use DateTimeZone;
use Yasumi\Provider\Australia\Tasmania\South;

/**
 * Provider for all holidays in southeastern Tasmania (Australia).
 *
 */
class Southeast extends South
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region. This one is not a proper ISO3166 code, but there aren't any for areas within Tasmania,
     * and I believe it to be a logical extension.
     */
    const ID = 'AU-TAS-SOU-SE';

    public $timezone = 'Australia/Hobart';

    /**
     * Initialize holidays for southeastern Tasmania (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->removeHoliday('recreationDay');
        $this->calculateHobartRegatta();
    }

    /**
     * Royal Hobart Regatta
     *
     * @throws \Exception
     */
    public function calculateHobartRegatta()
    {
        $this->calculateHoliday(
            'hobartRegatta',
            ['en_AU' => 'Royal Hobart Regatta'],
            new DateTime('second monday of february ' . $this->year, new DateTimeZone($this->timezone)),
            false,
            false
        );
    }
}
