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

namespace Yasumi\tests\Australia;

use Yasumi\Holiday;
use Yasumi\Yasumi;

trait MonarchsBirthdayTransitionTestTrait
{
    /**
     * Tests the 2022 to 2023 monarchy transition and deprecated holiday alias.
     *
     * @throws \Exception
     */
    public function testMonarchsBirthdayNameTransition(): void
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            'monarchsBirthday',
            2022,
            ['en_AU' => 'Queen’s Birthday']
        );
        $this->assertTranslatedHolidayName(
            $this->region,
            'monarchsBirthday',
            2023,
            ['en_AU' => 'King’s Birthday']
        );
        $this->assertTranslatedHolidayName(
            $this->region,
            'queensBirthday',
            2022,
            ['en_AU' => 'Queen’s Birthday']
        );
        $this->assertTranslatedHolidayName(
            $this->region,
            'queensBirthday',
            2023,
            ['en_AU' => 'King’s Birthday']
        );
    }

    /**
     * Tests the deprecated Queen's Birthday key aliases the Monarch's Birthday date.
     *
     * @throws \Exception
     */
    public function testQueensBirthdayAliasMatchesMonarchsBirthday(): void
    {
        foreach ([2022, 2023] as $year) {
            $holidays = Yasumi::create($this->region, $year);
            $monarchsBirthday = $holidays->getHoliday('monarchsBirthday');
            $queensBirthday = $holidays->getHoliday('queensBirthday');

            self::assertInstanceOf(Holiday::class, $monarchsBirthday);
            self::assertInstanceOf(Holiday::class, $queensBirthday);
            self::assertSame($monarchsBirthday->format('Y-m-d'), $queensBirthday->format('Y-m-d'));
        }
    }
}
