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
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Yasumi;

/**
 * Class SecondInternationalWorkersDayTest
 * @package Yasumi\tests\Ukraine
 */
class SecondInternationalWorkersDayTest extends UkraineBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'secondInternationalWorkersDay';

    /**
     * Tests International Workers' Day.
     *
     * @dataProvider SecondInternationalWorkersDayDataProvider
     *
     * @param int $year the year for which International Workers' Day needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testSecondInternationalWorkersDay($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests International Workers' Day since 2018.
     * @throws ReflectionException
     */
    public function testNoSecondInternationalWorkersDaySince2018(): void
    {
        $year = $this->generateRandomYear(2018);
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
            $this->generateRandomYear(null, 2017),
            [self::LOCALE => 'День міжнародної солідарності трудящих']
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
            $this->generateRandomYear(null, 2017),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Returns a list of random test dates used for assertion of International Workers' Day.
     *
     * @return array list of test dates for International Workers' Day
     * @throws \Exception
     */
    public function SecondInternationalWorkersDayDataProvider(): array
    {
        $data = [];

        for ($y = 0; $y < 10; $y++) {
            $year = $this->generateRandomYear(null, 2017);
            $data[] = [$year, new \DateTime("$year-05-02", new \DateTimeZone(self::TIMEZONE))];
        }

        return $data;
    }
}
