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

use Yasumi\Holiday;
use Yasumi\tests\Australia\AustraliaTest;

/**
 * Class for testing holidays in Victoria (Australia).
 */
class VictoriaTest extends AustraliaTest
{
    public $region = 'Australia\Victoria';

    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Victoria (Australia) are defined by the provider class
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
            'queensBirthday',
            'labourDay',
            'aflGrandFinalFriday'
        ], $this->region, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp()
    {
        $this->year = $this->generateRandomYear(2015, 2016);
    }
}
