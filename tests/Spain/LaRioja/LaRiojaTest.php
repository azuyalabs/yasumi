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
namespace Yasumi\Tests\Spain\LaRioja;

/**
 * Class for testing holidays in La Rioja (Spain).
 */
class LaRiojaTest extends LaRiojaBaseTestCase
{
    /**
     * Tests if all holidays in La Rioja are defined by the provider class
     */
    public function testDefinedHolidays()
    {
        $this->assertClassHasStaticAttribute('expectedHolidays', self::class);
        $this->assertDefinedHolidays(self::REGION, date('Y'), self::$expectedHolidays);
    }
}
