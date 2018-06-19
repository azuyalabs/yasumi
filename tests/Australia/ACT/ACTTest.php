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

namespace Yasumi\tests\Australia\ACT;

use Yasumi\Holiday;

/**
 * Class for testing holidays in ACT (Australia).
 */
class ACTTest extends ACTBaseTestCase
{
    public $region = 'Australia\ACT';

    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in ACT (Australia) are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'goodFriday',
            'easterMonday',
            'christmasDay',
            'secondChristmasDay',
            'australiaDay',
            'anzacDay',
            'easter',
            'easterSaturday',
            'queensBirthday',
            'labourDay',
            'canberraDay',
            'reconciliationDay'
        ], $this->region, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp()
    {
        $this->year = $this->generateRandomYear(2018, 2100);
    }
}
