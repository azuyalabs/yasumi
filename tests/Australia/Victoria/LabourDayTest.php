<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Australia\Victoria;

/**
 * Class for testing Labour Day in Victoria (Australia)..
 */
class LabourDayTest extends \Yasumi\tests\Australia\LabourDayTest
{
    public $region = 'Australia\Victoria';

    public $timezone = 'Australia/Melbourne';

    protected $dateFormat = 'second Monday of March';

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        $data = [
            [2010, '2010-03-08'],
            [2011, '2011-03-14'],
            [2012, '2012-03-12'],
            [2013, '2013-03-11'],
            [2014, '2014-03-10'],
            [2015, '2015-03-09'],
            [2016, '2016-03-14'],
            [2017, '2017-03-13'],
            [2018, '2018-03-12'],
            [2019, '2019-03-11'],
            [2020, '2020-03-09'],
        ];


        return $data;
    }
}
