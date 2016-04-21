<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Dorian Neto <doriansampaioneto@gmail.com>
 */

namespace Yasumi\tests\Brazil;

use DateInterval;
use Yasumi\Provider\ChristianHolidays;

/**
 * Class for testing Good Friday in the Brazil.
 */
class GoodFridayTest extends BrazilBaseTestCase
{
    use ChristianHolidays;

    /**
     * The name of the holiday
     */
    const HOLIDAY = 'goodFriday';

    /**
     * Tests Good Friday.
     */
    public function testGoodFriday()
    {
        $year = 1997;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            $this->calculateEaster($year, self::TIMEZONE)->sub(new DateInterval('P2D')));
    }

    /**
     * Tests translated name of Good Friday.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pt_BR' => 'Sexta feira santa']);
    }
}
