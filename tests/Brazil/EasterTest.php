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

namespace Yasumi\Tests\Brazil;

use Yasumi\Provider\ChristianHolidays;

/**
 * Class for testing Easter in the Brazil.
 */
class EasterTest extends BrazilBaseTestCase
{
    use ChristianHolidays;

    /**
     * The name of the holiday
     */
    const HOLIDAY = 'easter';

    /**
     * Tests Easter.
     */
    public function testEaster()
    {
        $year = 1948;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, 
            $this->calculateEaster($year, self::TIMEZONE));
    }

    /**
     * Tests translated name of Easter.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pt_BR' => 'Páscoa']);
    }
}
