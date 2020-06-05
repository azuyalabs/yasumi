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
 * Class for testing Autumnal Equinox Day in Japan.
 */
class AutumnalEquinoxDayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'autumnalEquinoxDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests Autumnal Equinox Day after 2150. This national holiday was established in 1948 as a day on which to honor
     * one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial ancestor worship
     * festival called Shūki kōrei-sai (秋季皇霊祭).
     *
     * After 2150 no calculations are available yet.
     * @throws ReflectionException
     */
    public function testAutumnalEquinoxDayOnAfter2150(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(2151));
    }

    /**
     * Tests Autumnal Equinox Day between 1948 and 2150. This national holiday was established in 1948 as a day on which
     * to honor one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial ancestor
     * worship festival called Shūki kōrei-sai (秋季皇霊祭).
     *
     * After 2150 no calculations are available yet.
     *
     * @dataProvider autumnalEquinoxHolidaysProvider
     *
     * @param int $year year of example data to be tested
     * @param int $month month (number) of example data to be tested
     * @param int $day day of the month (number) of example data to be tested
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testAutumnalEquinoxDayBetween1948And2150($year, $month, $day): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-$month-$day", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Returns a list of all Japanese Autumnal Equinox holidays used for assertions.
     *
     * @return array list of Japanese Autumnal Equinox holidays
     */
    public function autumnalEquinoxHolidaysProvider(): array
    {
        return [
            [1951, 9, 24],
            [1999, 9, 23],
            [2013, 9, 23],
            [2016, 9, 22],
            [2122, 9, 23],
        ];
    }

    /**
     * Tests Autumnal Equinox Day before 1948. This national holiday was established in 1948 as a day on which to honor
     * one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial ancestor worship
     * festival called Shūki kōrei-sai (秋季皇霊祭).
     * @throws ReflectionException
     */
    public function testAutumnalEquinoxDayBefore1948(): void
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2150),
            [self::LOCALE => '秋分の日']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2150),
            Holiday::TYPE_OFFICIAL
        );
    }
}
