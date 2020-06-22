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
 * Class for testing National Foundation Day in Japan.
 */
class NationalFoundationDayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'nationalFoundationDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1966;

    /**
     * Tests National Foundation Day after 1966. National Foundation day was established after 1966
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNationalFoundationDayOnAfter1966(): void
    {
        $year = 1972;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-2-11", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests National Foundation Day after 1966. substituted next working day (when National Foundation Day falls on a
     * Sunday)
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNationalFoundationDayOnAfter1966SubstitutedNextWorkingDay(): void
    {
        $year = 2046;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-2-12", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests National Foundation Day before 1966. National Foundation day was established after 1966
     * @throws ReflectionException
     */
    public function testNationalFoundationDayBefore1966(): void
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
            [self::LOCALE => '建国記念の日']
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
