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

namespace Yasumi\tests\Denmark;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing summer time in Denmark.
 */
class SummerTimeTest extends DenmarkBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'summerTime';

    /**
     * Tests the holiday defined in this test.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSummerTime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(1949, 1979));

        $year = $this->generateRandomYear(1980, 2036);
        $expectedDate = new DateTime("last sunday of march $year", new DateTimeZone(self::TIMEZONE));

        // Since 1980 Summertime in Denmark starts on the last day of March. In 1980 itself however, it started on April, 6th.
        if (1980 === $year) {
            $expectedDate = new DateTime('1980-04-06', new DateTimeZone(self::TIMEZONE));
        }

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $expectedDate
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
            $this->generateRandomYear(1980, 2037),
            [self::LOCALE => 'sommertid starter']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1980, 2037), Holiday::TYPE_SEASON);
    }
}
