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

namespace Yasumi\tests\Switzerland\Valais;

use DateTime;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing St. Joseph's Day in Valais (Switzerland).
 */
class StJosephDayTest extends ValaisBaseTestCase implements YasumiTestCaseInterface
{
    use ChristianHolidays;

    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'stJosephsDay';

    /**
     * Tests St. Joseph's Day.
     *
     * @dataProvider StJosephDayDataProvider
     *
     * @param int $year the year for which St. Joseph's Day needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testStJosephDay($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of St. Joseph's Day.
     *
     * @return array list of test dates for St. Joseph's Day
     * @throws Exception
     */
    public function StJosephDayDataProvider(): array
    {
        return $this->generateRandomDates(3, 19, self::TIMEZONE);
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
            [self::LOCALE => 'Saint-Joseph']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
