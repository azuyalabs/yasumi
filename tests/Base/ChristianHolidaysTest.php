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
}
