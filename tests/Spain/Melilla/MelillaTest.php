<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Tests\Spain\Melilla;

/**
 * Class for testing holidays in Melilla (Spain).
 */
class MelillaTest extends MelillaBaseTestCase
{
    /**
     * Tests if all holidays in Melilla are defined by the provider class
     */
    public function testDefinedHolidays()
    {
        $this->assertClassHasStaticAttribute('expectedHolidays', self::class);
        $this->assertDefinedHolidays(self::REGION, date('Y'), self::$expectedHolidays);
    }
}
