<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Netherlands;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Wintertime in the Netherlands.
 */
class WintertimeTest extends NetherlandsBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'winterTime';

    /**
     * Tests Wintertime.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testWintertime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(1946, 1976));

        $year = $this->generateRandomYear(1979, 1995);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("last sunday of september $year", new DateTimeZone(self::TIMEZONE))
        );

        $year = $this->generateRandomYear(1996, 2037);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("last sunday of october $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1978, 2037),
            [self::LOCALE => 'wintertijd']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1978, 2037), Holiday::TYPE_SEASON);
    }
}
