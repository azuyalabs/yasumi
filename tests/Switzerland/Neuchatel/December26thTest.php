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

namespace Yasumi\tests\Switzerland\Neuchatel;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing December 26th in Neuchatel (Switzerland).
 */
class December26thTest extends NeuchatelBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'december26th';

    /**
     * One of the year the holiday is observed
     */
    public const OBSERVANCE_YEAR = 2022;

    /**
     * Tests December 26th.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testDecember26th(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            self::OBSERVANCE_YEAR,
            new DateTime(self::OBSERVANCE_YEAR.'-12-26', new DateTimeZone(self::TIMEZONE))
        );
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2020
        );
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2021
        );
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2023
        );
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2024
        );
    }

    /**
     * Tests translated name of December 26th.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            self::OBSERVANCE_YEAR,
            [self::LOCALE => '26 décembre']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, self::OBSERVANCE_YEAR, Holiday::TYPE_OTHER);
    }
}
