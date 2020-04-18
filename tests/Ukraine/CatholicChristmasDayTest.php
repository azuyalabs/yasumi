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

namespace Yasumi\tests\Ukraine;

use DateTime;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Yasumi;

/**
 * Class CatholicChristmasDayTest
 * @package Yasumi\tests\Ukraine
 */
class CatholicChristmasDayTest extends UkraineBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'catholicChristmasDay';

    /**
     * Tests Catholic Christmas Day.
     *
     * @dataProvider CatholicChristmasDayDataProvider
     *
     * @param int $year the year for which International Workers' Day needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testCatholicChristmasDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests Catholic Christmas Day before 2017.
     * @throws ReflectionException
     */
    public function testNoCatholicChristmasDayBefore2017()
    {
        $year = $this->generateRandomYear(null, 2016);
        $holidays = Yasumi::create(self::REGION, $year);
        $holiday = $holidays->getHoliday(self::HOLIDAY);

        $this->assertNull($holiday);

        unset($year, $holiday, $holidays);
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
            $this->generateRandomYear(2017),
            [self::LOCALE => 'Католицький день Різдва']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(2017), Holiday::TYPE_OFFICIAL);
    }

    /**
     * Returns a list of random test dates used for assertion of Catholic Christmas Day.
     *
     * @return array list of test dates for Catholic Christmas Day
     * @throws Exception
     */
    public function CatholicChristmasDayDataProvider(): array
    {
        $data = [];

        for ($y = 0; $y < 10; $y++) {
            $year = $this->generateRandomYear(2017);
            $data[] = [$year, new \DateTime("$year-12-25", new \DateTimeZone(self::TIMEZONE))];
        }

        return $data;
    }
}
