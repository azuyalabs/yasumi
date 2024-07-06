<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Iran;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

class IranTest extends IranBaseTestCase implements ProviderTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected int $year;

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear();
    }

    public function testOfficialHolidays(): void
    {
        $holidays = [
            'nowruz1',
            'nowruz2',
            'nowruz3',
            'nowruz4',
            'sizdahBedar',
        ];

        if (1979 <= $this->year) {
            $holidays[] = 'islamicRepublicDay';
            $holidays[] = 'revoltOfKhordad15';
            $holidays[] = 'anniversaryOfIslamicRevolution';
        }

        if (1989 <= $this->year) {
            $holidays[] = 'deathOfKhomeini';
        }

        if (1951 <= $this->year) {
            $holidays[] = 'nationalizationOfTheIranianOilIndustry';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 2);
    }
}
