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

namespace Yasumi\tests\Australia\SA;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Christmas Day in South Australia.
 */
class ChristmasDayTest extends SABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'christmasDay';
    public const HOLIDAY2 = 'christmasHoliday';

    /**
     * Tests Christmas Day
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
    public function testHoliday($year, $expected, $expectedExtra)
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
        $data = [
            [2010, '2010-12-25', '2010-12-27'],
            [2011, '2011-12-25', '2011-12-26'],
            [2012, '2012-12-25', null],
            [2013, '2013-12-25', null],
            [2014, '2014-12-25', null],
            [2015, '2015-12-25', null],
            [2016, '2016-12-25', '2016-12-26'],
            [2017, '2017-12-25', null],
            [2018, '2018-12-25', null],
            [2019, '2019-12-25', null],
            [2020, '2020-12-25', null],
        ];

        return $data;
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
            [self::LOCALE => 'Christmas Day']
        );
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY2,
            2016,
            [self::LOCALE => 'Christmas Holiday']
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
        $this->assertHolidayType($this->region, self::HOLIDAY2, 2016, Holiday::TYPE_OFFICIAL);
    }
}
