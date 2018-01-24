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

namespace Yasumi\tests\Switzerland\Geneva;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Restauration Genevoise in Geneva (Switzerland).
 */
class RestaurationGenevoiseTest extends GenevaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'restaurationGenevoise';

    /**
     * Tests Restauration Genevoise.
     */
    public function testRestaurationGenevoiseAfter1813()
    {
        $year = $this->generateRandomYear(1814);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime($year . '-12-31', new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of Restauration Genevoise.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1814),
            [self::LOCALE => 'Restauration de la République']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1814), Holiday::TYPE_OTHER);
    }
}
