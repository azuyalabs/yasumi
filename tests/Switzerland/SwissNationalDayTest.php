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

namespace Yasumi\tests\Switzerland;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for National Day in Switzerland.
 */
class SwissNationalDayTest extends SwitzerlandBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'swissNationalDay';

    /**
     * The year in which the holiday was established as national holiday
     */
    public const NATIONAL_ESTABLISHMENT_YEAR = 1994;

    /**
     * The year in which the holiday was first established
     */
    public const FIRST_ESTABLISHMENT_YEAR = 1899;

    /**
     * The year in which the holiday was first observed
     */
    public const FIRST_OBSERVANCE_YEAR = 1891;

    /**
     * Tests National Day on or after 1994.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNationalDayOnAfter1994()
    {
        $year = $this->generateRandomYear(self::NATIONAL_ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-8-01", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests National Day on or after 1899 and before 1994.
     * @throws ReflectionException
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNationalDayOnAfter1899()
    {
        $year = $this->generateRandomYear(self::FIRST_ESTABLISHMENT_YEAR, self::NATIONAL_ESTABLISHMENT_YEAR - 1);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-8-01", new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests National Day on 1891
     * @throws ReflectionException
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNationalDayOn1891()
    {
        $year = self::FIRST_OBSERVANCE_YEAR;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-8-01", new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests National Day before 1891.
     * @throws ReflectionException
     */
    public function testNationalDayBefore1891()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::FIRST_OBSERVANCE_YEAR - 1)
        );
    }

    /**
     * Tests National Day between 1891 and 1899.
     * @throws ReflectionException
     */
    public function testNationalDayBetween1891And1899()
    {
        $year = $this->generateRandomYear(self::FIRST_OBSERVANCE_YEAR + 1, self::FIRST_ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of National Day.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::NATIONAL_ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Bundesfeiertag']
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
            $this->generateRandomYear(self::NATIONAL_ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
