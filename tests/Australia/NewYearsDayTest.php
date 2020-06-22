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

namespace Yasumi\tests\Australia;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing New Years Day in Australia.
 */
class NewYearsDayTest extends AustraliaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'newYearsDay';
    public const HOLIDAY2 = 'newYearsHoliday';

    /**
     * Tests New Years Day
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int $year the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     * @param string $expectedExtra the expected date for the additional holiday, or null if no additional holiday
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHoliday($year, $expected, $expectedExtra): void
    {
        $this->assertHoliday(
            $this->region,
            self::HOLIDAY,
            $year,
            new DateTime($expected, new DateTimeZone($this->timezone))
        );
        if (null === $expectedExtra) {
            $this->assertNotHoliday(
                $this->region,
                self::HOLIDAY2,
                $year
            );
        } else {
            $this->assertHoliday(
                $this->region,
                self::HOLIDAY2,
                $year,
                new DateTime($expectedExtra, new DateTimeZone($this->timezone))
            );
        }
    }

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider(): array
    {
        return [
            [2010, '2010-01-01', null],
            [2011, '2011-01-01', '2011-01-03'],
            [2012, '2012-01-01', '2012-01-02'],
            [2013, '2013-01-01', null],
            [2014, '2014-01-01', null],
            [2015, '2015-01-01', null],
            [2016, '2016-01-01', null],
            [2017, '2017-01-01', '2017-01-02'],
            [2018, '2018-01-01', null],
            [2019, '2019-01-01', null],
            [2020, '2020-01-01', null],
        ];
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'New Year’s Day']
        );
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY2,
            2017,
            [self::LOCALE => 'New Year’s Holiday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
        $this->assertHolidayType($this->region, self::HOLIDAY2, 2017, Holiday::TYPE_OFFICIAL);
    }
}
