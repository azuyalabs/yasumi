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

namespace Yasumi\tests\Benin;

use Yasumi\Holiday;
use Yasumi\Provider\Benin;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing People’s Sovereignty Day in Benin.
 *
 * Fixed date: 28 February. A National Day commemorated without a day off (Law 90-019, article 3).
 */
class PeoplesSovereigntyDayTest extends BeninBaseTestCase implements HolidayTestCase
{
    /**
     * The key of the holiday.
     */
    public const HOLIDAY = 'peoplesSovereigntyDay';

    /**
     * Tests People’s Sovereignty Day.
     *
     * @param int                $year     the year for which People’s Sovereignty Day needs to be tested
     * @param \DateTimeInterface $expected the expected date
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('HolidayDataProvider')]
    public function testHoliday(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of People’s Sovereignty Day.
     *
     * @return array<array{int, \DateTimeInterface}> list of test dates for People’s Sovereignty Day
     *
     * @throws \Exception
     */
    public static function HolidayDataProvider(): array
    {
        return static::generateRandomDatesSinceEstablishment(2, 28);
    }

    /**
     * Tests that People’s Sovereignty Day is not defined before the establishment year.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Benin::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Tests the translated name of People’s Sovereignty Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Benin::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Journée de la Souveraineté du Peuple', 'en' => 'People’s Sovereignty Day']
        );
    }

    /**
     * Tests the type of People’s Sovereignty Day.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Benin::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OBSERVANCE
        );
    }
}
