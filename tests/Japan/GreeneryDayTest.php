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
 * Class testing Greenery Day in Japan.
 */
class GreeneryDayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday defined in the test
     */
    public const HOLIDAY = 'greeneryDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1989;

    /**
     * Tests Greenery Day after 2007. Greenery Day was established from 1989 on April 29th. After 2007
     * it was changed to be May 4th.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidayOnAfter2007()
    {
        $year = 2112;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-5-4", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Greenery Day after 2007 substituted next working day (when Greenery Day falls on a Sunday)
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidayOnAfter2007SubstitutedNextWorkingDay()
    {
        $year = 2014;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-5-6", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Greenery Day between 1989 and 2007. Greenery Day was established from 1989 on April 29th. After 2007
     * it was changed to be May 4th.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidayBetween1989And2007()
    {
        $year = 1997;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-4-29", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Greenery Day between 1989 and 2007 substituted next working day (when Greenery Day falls on a Sunday)
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidayBetween1989And2007SubstitutedNextWorkingDay()
    {
        $year = 2001;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-4-30", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Greenery Day before 1989. Greenery Day was established from 1989 on April 29th. After 2007
     * it was changed to be May 4th.
     * @throws ReflectionException
     */
    public function testHolidayBefore1989()
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'みどりの日']
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
