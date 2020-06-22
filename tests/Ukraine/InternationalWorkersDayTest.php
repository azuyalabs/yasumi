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

/**
 * Class InternationalWorkersDayTest
 * @package Yasumi\tests\Ukraine
 */
class InternationalWorkersDayTest extends UkraineBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'internationalWorkersDay';

    /**
     * Tests International Workers' Day.
     *
     * @dataProvider InternationalWorkersDayDataProvider
     *
     * @param int $year the year for which International Workers' Day needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testInternationalWorkersDay($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
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
            [self::LOCALE => 'День міжнародної солідарності трудящих']
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

    /**
     * Returns a list of random test dates used for assertion of International Workers' Day.
     *
     * @return array list of test dates for International Workers' Day
     * @throws Exception
     */
    public function InternationalWorkersDayDataProvider(): array
    {
        return $this->generateRandomDates(5, 1, self::TIMEZONE);
    }
}
