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
 * Class for testing Australia day in Australia.
 */
class AustraliaDayTest extends AustraliaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'australiaDay';

    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int $year the year for which the holiday defined in this test needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testHoliday($year, $expected): void
    {
        $this->assertHoliday($this->region, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests Australia Day
     *
     * @dataProvider SubstituteHolidayDataProvider
     *
     * @param int $year the year for which the holiday defined in this test needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testSubstituteHoliday($year, $expected): void
    {
        if ($expected) {
            $this->assertSubstituteHoliday(
                $this->region,
                self::HOLIDAY,
                $year,
                new DateTime($expected, new DateTimeZone($this->timezone))
            );
        } else {
            $this->assertNotSubstituteHoliday(
                $this->region,
                self::HOLIDAY,
                $year
            );
        }
    }


    /**
     * Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(2000),
            [self::LOCALE => 'Australia Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, $this->generateRandomYear(2000), Holiday::TYPE_OFFICIAL);
    }

    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test
     *
     * @return array list of test dates for the holiday defined in this test
     * @throws Exception
     */
    public function HolidayDataProvider(): array
    {
        return $this->generateRandomDates(1, 26, $this->timezone);
    }

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function SubstituteHolidayDataProvider(): array
    {
        return [
            [2010, null],
            [2011, null],
            [2012, null],
            [2013, '2013-01-28'],
            [2014, '2014-01-27'],
            [2015, null],
            [2016, null],
            [2017, null],
            [2018, null],
            [2019, '2019-01-28'],
            [2020, '2020-01-27'],
        ];
    }
}
