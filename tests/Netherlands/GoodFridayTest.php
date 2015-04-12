<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Tests\Netherlands;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Good Friday.
 *
 * Good Friday is a Christian religious holiday commemorating the crucifixion of Jesus Christ and his death at Calvary.
 * The holiday is observed during Holy Week as part of the Paschal Triduum on the Friday preceding Easter Sunday, and
 * may coincide with the Jewish observance of Passover.
 */
class GoodFridayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Ash Wednesday.
     */
    public function testGoodFriday()
    {
        $year = 1876;
        $this->assertHoliday(self::COUNTRY, 'goodFriday', $year,
            new DateTime("$year-4-14", new DateTimeZone(self::TIMEZONE)));
    }
}
