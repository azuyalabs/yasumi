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

namespace Yasumi\tests\Portugal;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Restoration of Independence Day in Portugal.
 */
class PortugueseRepublicDayTest extends PortugalBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1910;

    /**
     * Holiday was restored by the portuguese government in 2016.
     */
    public const HOLIDAY_YEAR_RESTORED = 2016;

    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'portugueseRepublic';

    /**
     * Test that the holiday if in effect in 2016 and later dates.
     * @throws ReflectionException
     * @throws Exception
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHolidayOnAfterRestoration(): void
    {
        $year = self::HOLIDAY_YEAR_RESTORED;

        $expected = new DateTime("$year-10-05", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);

        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);

        $expected = new DateTime("$year-10-05", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Test that the holiday did not happen in 2013-2015.
     * @throws ReflectionException
     */
    public function testNotHolidayDuringAbolishment(): void
    {
        $year = $this->generateRandomYear(2013, 2015);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the holiday defined in this test on or after establishment.
     * @throws ReflectionException
     * @throws Exception
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHolidayOnAfterEstablishment(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);

        $expected = new DateTime("$year-10-05", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);

        $year = self::ESTABLISHMENT_YEAR;
        $expected = new DateTime("$year-10-05", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests the holiday defined in this test before establishment.
     *
     * @throws ReflectionException
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);

        $year = self::ESTABLISHMENT_YEAR - 1;
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Implantação da República Portuguesa']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
