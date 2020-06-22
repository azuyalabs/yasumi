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

namespace Yasumi\tests\USA;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing New Years Day in the USA.
 */
class NewYearsDayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNewYearsDay(): void
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
     * Tests New Years Day when substituted on Monday (when New Years Day falls on Sunday).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNewYearsDaySubstitutedMonday(): void
    {
        $year = 2445;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:newYearsDay',
            $year,
            new DateTime("$year-1-2", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests New Years Day when substituted on Friday (when New Years Day falls on Saturday).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNewYearsDaySubstitutedFriday(): void
    {
        $year = 1938;
        $subYear = $year - 1;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:newYearsDay',
            $year,
            new DateTime("$subYear-12-31", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'New Year’s Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
