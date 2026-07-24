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

namespace Yasumi\tests\SouthKorea\Policy;

use PHPUnit\Framework\Attributes\DataProvider;
use Yasumi\Provider\SouthKorea\Policy\SubstitutePolicy;
use Yasumi\tests\SouthKorea\SouthKoreaBaseTestCase;
use Yasumi\Yasumi;

class SubstitutePolicyTest extends SouthKoreaBaseTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'liberationDay';

    public const YEAR_LOWER_BOUND = 2023;

    public const YEAR_UPPER_BOUND = 9999;

    /**
     * Tests whether the function that determines the substitute holiday condition works properly.
     *
     * @throws \Exception
     */
    #[DataProvider('YearsDataProvider')]
    public function testSubstitutePolicy(int $year): void
    {
        $holiday = Yasumi::create(self::REGION, $year)->getHoliday(self::HOLIDAY);

        $policy = new SubstitutePolicy($year);
        $this->assertTrue($policy->canSubsitute($holiday));

        if (self::isWeekend($holiday)) {
            $this->assertTrue($policy->shouldSubstitute($holiday));
        } else {
            $this->assertFalse($policy->shouldSubstitute($holiday));
        }
    }

    public static function YearsDataProvider(): \Generator
    {
        for ($i = 0; $i < 20; ++$i) {
            yield [static::numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND)];
        }
    }
}
