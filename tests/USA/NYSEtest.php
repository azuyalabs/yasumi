<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *  Copyright (c) 2016 MGWebGroup
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Alex Kay <alex110504@gmail.com>
 */

namespace Yasumi\tests\USA;

use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;
use Yasumi\Holiday;

/**
 * Class for testing holidays in the USA.
 */
class NYSETest extends USABaseTestCase
{

    /**
     * Name to be tested
     */
    const ID = 'NYSE';

    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;
 

    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'martinLutherKingDay',
            'washingtonsBirthday',
            'goodFriday',
            'memorialDay',
            'independenceDay',
            'labourDay',
            'thanksgivingDay',
            'christmasDay'
        ], self::ID, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp()
    {
        $this->year = $this->generateRandomYear(1986);
    }
}
