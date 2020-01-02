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
 * Class to test Independence Day.
 */
class IndependenceDayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'independenceDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1776;

    /**
     * Tests Independence Day on or after 1776. Independence Day is celebrated since 1776 on July 4th.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIndependenceDayOnAfter1776()
    {
        $year = 1955;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-7-4", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Independence Day on or after 1776 when substituted on Monday (when Independence Day falls on Sunday)
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIndependenceDayOnAfter1776SubstitutedMonday()
    {
        $year = 3362;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:independenceDay',
            $year,
            new DateTime("$year-7-5", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Independence Day on or after 1776 when substituted on Friday (when Independence Day falls on Saturday)
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIndependenceDayOnAfter1776SubstitutedFriday()
    {
        $year = 8291;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:independenceDay',
            $year,
            new DateTime("$year-7-3", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Independence Day before 1776. Independence Day is celebrated since 1776 on July 4th.
     * @throws ReflectionException
     */
    public function testIndependenceDayBefore1776()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Independence Day']
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
