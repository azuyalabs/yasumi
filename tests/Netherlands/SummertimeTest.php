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
 * Class for testing Summertime in the Netherlands.
 */
class SummertimeTest extends NetherlandsBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'summerTime';

    /**
     * Tests Summertime.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSummertime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(1946, 1976));

        $year = $this->generateRandomYear(1977, 1980);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("first sunday of april $year", new DateTimeZone(self::TIMEZONE))
        );

        $year = $this->generateRandomYear(1981, 2036);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("last sunday of march $year", new DateTimeZone(self::TIMEZONE))
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
            [self::LOCALE => 'zomertijd']
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
