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


namespace Yasumi\tests\Slovakia;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing a holiday in Slovakia.
 *
 *
 * @package Yasumi\tests\Slovakia
 * @author  Andrej Rypak (dakujem) <xrypak@gmail.com>
 */
class GoodFridayTest extends SlovakiaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'goodFriday';


    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int $year the year for which Christmas Day needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testHoliday($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }


    /**
     * Returns a list of test dates used for assertion of the holiday defined in this test
     *
     * @return array list of test dates for the holiday defined in this test
     * @throws Exception
     */
    public function HolidayDataProvider(): array
    {
        $timezone = self::TIMEZONE;

        return [
            [1788, new DateTime('1788-3-21', new DateTimeZone($timezone))],
            [1876, new DateTime('1876-4-14', new DateTimeZone($timezone))],
            [2016, new DateTime('2016-3-25', new DateTimeZone($timezone))],
            [2017, new DateTime('2017-4-14', new DateTimeZone($timezone))],
            [2018, new DateTime('2018-3-30', new DateTimeZone($timezone))],
            [2019, new DateTime('2019-4-19', new DateTimeZone($timezone))],
            [2020, new DateTime('2020-4-10', new DateTimeZone($timezone))],
            [2050, new DateTime('2050-4-8', new DateTimeZone($timezone))],
        ];
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
            [self::LOCALE => 'Veľký piatok']
        );
    }


    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }
}
