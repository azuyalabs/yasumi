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

namespace Yasumi\tests\SouthKorea;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Children's Day in South Korea.
 */
class ChildrensDayTest extends SouthKoreaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'childrensDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1970;

    /**
     * Tests the holiday defined in this test.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testMainHoliday(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-5-5", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Buddha's Birthday).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSubstituteHolidayByBuddhasBirthday(): void
    {
        foreach ([2025, 2044] as $year) {
            $this->assertHoliday(
                self::REGION,
                'substituteHoliday:childrensDay',
                $year,
                new DateTime("$year-5-6", new DateTimeZone(self::TIMEZONE))
            );
        }
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Saturday).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSubstituteHolidayBySaturday(): void
    {
        $year = 2029;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:childrensDay',
            $year,
            new DateTime("$year-5-7", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Sunday).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSubstituteHolidayBySunday(): void
    {
        $year = 2019;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:childrensDay',
            $year,
            new DateTime("$year-5-6", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday defined in this test before establishment.
     * @throws ReflectionException
     */
    public function testHolidayBeforeEstablishment(): void
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
            [self::LOCALE => '어린이날']
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
