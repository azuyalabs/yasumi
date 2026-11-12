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
 * Class for testing International Women’s Day in Benin.
 *
 * Fixed date: 8 March. A National Day commemorated without a day off (Law 90-019, article 3).
 */
class InternationalWomensDayTest extends BeninBaseTestCase implements HolidayTestCase
{
    /**
     * The key of the holiday.
     */
    public const HOLIDAY = 'internationalWomensDay';

    /**
     * Tests International Women’s Day.
     *
     * @param int                $year     the year for which International Women’s Day needs to be tested
     * @param \DateTimeInterface $expected the expected date
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('HolidayDataProvider')]
    public function testHoliday(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of International Women’s Day.
     *
     * @return array<array{int, \DateTimeInterface}> list of test dates for International Women’s Day
     *
     * @throws \Exception
     */
    public static function HolidayDataProvider(): array
    {
        return static::generateRandomDatesSinceEstablishment(3, 8);
    }

    /**
     * Tests that International Women’s Day is not defined before the establishment year.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Benin::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Tests the translated name of International Women’s Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Benin::ESTABLISHMENT_YEAR),
            [
                self::LOCALE => 'Journée de la Femme',
                'fr' => 'Journée internationale des droits des femmes',
                'en' => 'International Women’s Day',
            ]
        );
    }

    /**
     * Tests the type of International Women’s Day.
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
