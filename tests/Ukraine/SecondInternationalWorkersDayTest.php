<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Ukraine;

use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

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
     * @param int       $year     the year for which International Workers' Day needs to be tested
     * @param \DateTime $expected the expected date
     *
     * @throws \ReflectionException
     */
    public function testSecondInternationalWorkersDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests translated name of the holiday defined in this test.
     * @throws \ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'День міжнародної солідарності трудящих']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws \ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }

    /**
     * Returns a list of random test dates used for assertion of International Workers' Day.
     *
     * @return array list of test dates for International Workers' Day
     * @throws \Exception
     */
    public function SecondInternationalWorkersDayDataProvider(): array
    {
        return $this->generateRandomDates(5, 2, self::TIMEZONE);
    }
}
