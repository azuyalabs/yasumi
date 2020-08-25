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
class ChristmasDayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day. Christmas Day is celebrated on December 25th.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testChristmasDay(): void
    {
        $year = 2001;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-12-25", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Christmas Day substituted on Monday (when Christmas Day falls on Sunday).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testChristmasDaySubstitutedMonday(): void
    {
        // Substituted Holiday on Monday (Christmas Day falls on Sunday)
        $year = 6101;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:christmasDay',
            $year,
            new DateTime("$year-12-26", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Christmas Day substituted on Monday (when Christmas Day falls on Saturday).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testChristmasDaySubstitutedFriday(): void
    {
        // Substituted Holiday on Friday (Christmas Day falls on Saturday)
        $year = 2060;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:christmasDay',
            $year,
            new DateTime("$year-12-24", new DateTimeZone(self::TIMEZONE))
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
            [self::LOCALE => 'Christmas']
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
