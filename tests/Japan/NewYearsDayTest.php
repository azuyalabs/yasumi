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

namespace Yasumi\tests\Japan;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing New Years Day in Japan.
 */
class NewYearsDayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'newYearsDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests New Years Day after 1948. New Years Day was established after 1948
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNewYearsDayOnAfter1948(): void
    {
        $year = 1997;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-1-1", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests New Years Day after 1948 substituted next working day (when New Years Day falls on a Sunday)
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNewYearsDayOnAfter1948SubstitutedNextWorkingDay(): void
    {
        $year = 4473;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-1-2", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests New Years Day before 1948. New Years Day was established after 1948
     * @throws ReflectionException
     */
    public function testNewYearsDayBefore1948(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => '元日']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
