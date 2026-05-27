<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\tests\HolidayTestCase;
use Yasumi\tests\SouthKorea\SouthKoreaBaseTestCase;

/**
 * Class for testing Labour Day in South Korea.
 */
class LabourDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'labourDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2026;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testLabourDay(): void
    {
        // From 2026 onwards.
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("{$year}-5-1", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 2026
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(null, self::ESTABLISHMENT_YEAR - 1),
        );
    }

    /**
     * Tests the substitute holiday defined in this test.
     *
     * @throws Exception
     */
    #[PHPUnit\Framework\Attributes\DataProvider('SubstituteHolidayDataProvider')]
    public function testSubstituteHoliday(int $year, string $expected): void
    {
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime($expected, DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => '노동절']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }

    public static function SubstituteHolidayDataProvider(): array
    {
        return [
            [2027, '2027-05-03'],
            [2032, '2032-05-03'],
            [2033, '2033-05-02'],
            [2038, '2038-05-03'],
            [2038, '2038-05-03'],
            [2039, '2039-05-03'],
            [2044, '2044-05-02'],
            [2049, '2049-05-03'],
        ];
    }
}
