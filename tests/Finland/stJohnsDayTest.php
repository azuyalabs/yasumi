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

namespace Yasumi\tests\Finland;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Yasumi;

/**
 * Class for testing St. John's Day / Midsummer's Day in Finland.
 *
 * Since 1955, the holiday has always been on a Saturday (between June 20 and June 26). Earlier it was always on
 * June 24.
 */
class stJohnsDayTest extends FinlandBaseTestCase implements YasumiTestCaseInterface
{

    /**
     * The year in which the holiday was adjusted
     */
    public const ADJUSTMENT_YEAR = 1955;

    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'stJohnsDay';

    /**
     * Tests the holiday before it was adjusted.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidayBeforeAdjustment(): void
    {
        $year = 1944;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-6-24", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday before it was adjusted.
     * @throws ReflectionException
     */
    public function testHolidayAfterAdjustment(): void
    {
        $year = $this->generateRandomYear(self::ADJUSTMENT_YEAR);

        $holidays = Yasumi::create(self::REGION, $year);
        $holiday = $holidays->getHoliday(self::HOLIDAY);

        // Some basic assertions
        $this->assertInstanceOf(Holiday::class, $holiday);
        $this->assertNotNull($holiday);

        // Holiday specific assertions
        $this->assertEquals('Saturday', $holiday->format('l'));
        $this->assertGreaterThanOrEqual(20, $holiday->format('j'));
        $this->assertLessThanOrEqual(26, $holiday->format('j'));

        unset($holiday, $holidays);
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
            $this->generateRandomYear(),
            [self::LOCALE => 'Juhannuspäivä']
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
