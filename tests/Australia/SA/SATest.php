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

namespace Yasumi\tests\Australia\SA;

use Yasumi\Holiday;

/**
 * Class for testing holidays in SA (Australia).
 */
class SATest extends SABaseTestCase
{
    public $region = 'Australia\SA';

    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in SA (Australia) are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'goodFriday',
            'easterMonday',
            'christmasDay',
            'proclamationDay',
            'australiaDay',
            'anzacDay',
            'easterSaturday',
            'queensBirthday',
            'labourDay',
            'adelaideCup'
        ], $this->region, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp()
    {
        $this->year = $this->generateRandomYear(1973);
    }
}
