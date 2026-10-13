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

namespace Yasumi\tests\Japan;

/**
 * Class for testing substitute holidays in Japan.
 */
class SubstituteHolidayTest extends JapanBaseTestCase
{
    /**
     * Tests that no substitute holiday is given for a holiday falling on a Sunday before April 12th, 1973.
     * Substitute holidays were introduced by the amendment of the National Holidays Act enforced on April 12th, 1973.
     *
     * @param string $holiday the key of the holiday falling on a Sunday
     * @param string $date    the date of the holiday falling on a Sunday
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('sundayHolidayBefore1973DataProvider')]
    public function testNoSubstituteHolidayBefore1973(string $holiday, string $date): void
    {
        $dateTime = new \DateTime($date, new \DateTimeZone(self::TIMEZONE));
        $year = (int) $dateTime->format('Y');

        self::assertSame('0', $dateTime->format('w'), "{$date} is expected to be a Sunday");
        $this->assertHoliday(self::REGION, $holiday, $year, $dateTime);
        $this->assertNotHoliday(self::REGION, self::SUBSTITUTE_PREFIX . $holiday, $year);
    }

    /**
     * Returns a list of holidays falling on a Sunday before April 12th, 1973.
     *
     * @return array<string, array{string, string}> list of holiday keys and dates
     */
    public static function sundayHolidayBefore1973DataProvider(): array
    {
        return [
            'National Foundation Day 1973' => ['nationalFoundationDay', '1973-02-11'],
            'Sports Day 1971' => ['sportsDay', '1971-10-10'],
            'Respect for the Aged Day 1968' => ['respectfortheAgedDay', '1968-09-15'],
            'Constitution Memorial Day 1959' => ['constitutionMemorialDay', '1959-05-03'],
        ];
    }

    /**
     * Tests the first substitute holiday after the amendment of the National Holidays Act enforced on April 12th, 1973.
     *
     * @throws \Exception
     */
    public function testFirstSubstituteHoliday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . 'emperorsBirthday',
            1973,
            new \DateTime('1973-04-30', new \DateTimeZone(self::TIMEZONE))
        );
    }
}
