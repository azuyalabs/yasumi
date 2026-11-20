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

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use Yasumi\Provider\ChristianHolidays;

class ChristianHolidaysTest extends TestCase
{
    /** @throws \Exception */
    public function testCachedEasterIsNotSharedBetweenCalls(): void
    {
        $provider = new class {
            use ChristianHolidays;

            public function easter(int $year, string $timezone): \DateTimeInterface
            {
                return $this->calculateEaster($year, $timezone);
            }

            public function orthodoxEaster(int $year, string $timezone): \DateTimeInterface
            {
                return $this->calculateOrthodoxEaster($year, $timezone);
            }
        };

        $provider->easter(2024, 'UTC')->add(new \DateInterval('P60D'));
        $provider->orthodoxEaster(2024, 'UTC')->add(new \DateInterval('P60D'));

        self::assertSame('2024-03-31', $provider->easter(2024, 'UTC')->format('Y-m-d'));
        self::assertSame('2024-05-05', $provider->orthodoxEaster(2024, 'UTC')->format('Y-m-d'));
    }

    /**
     * The Julian calendar falls one more day behind the Gregorian calendar in every century year that is not a
     * multiple of 400, so the gap is 10 days before 1700 and 14 days from 2100 onward. Dates checked against
     * dateutil.easter(year, EASTER_ORTHODOX).
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('orthodoxEasterDataProvider')]
    public function testOrthodoxEasterUsesTheJulianGregorianGapOfThatYear(int $year, string $expected): void
    {
        $provider = new class {
            use ChristianHolidays;

            public function orthodoxEaster(int $year, string $timezone): \DateTimeInterface
            {
                return $this->calculateOrthodoxEaster($year, $timezone);
            }
        };

        self::assertSame($expected, $provider->orthodoxEaster($year, 'UTC')->format('Y-m-d'));
    }

    /** @return array<int, array{int, string}> */
    public static function orthodoxEasterDataProvider(): array
    {
        return [
            [1583, '1583-04-10'],
            [1700, '1700-04-11'],
            [1899, '1899-04-30'],
            [1900, '1900-04-22'],
            [2024, '2024-05-05'],
            [2099, '2099-04-12'],
            [2100, '2100-05-02'],
            [2101, '2101-04-24'],
            [2200, '2200-04-06'],
            [2400, '2400-04-16'],
        ];
    }
}
