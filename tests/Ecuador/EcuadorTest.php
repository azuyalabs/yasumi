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

namespace Yasumi\tests\Ecuador;

use Yasumi\Holiday;
use Yasumi\Provider\Ecuador;
use Yasumi\tests\ProviderTestCase;

class EcuadorTest extends EcuadorBaseTestCase implements ProviderTestCase
{
    protected int $year;

    protected function setUp(): void
    {
        $this->year = static::generateRandomYear(Ecuador::INDEPENDENCE_OF_GUAYAQUIL_YEAR);
    }

    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'goodFriday',
            'carnavalMonday',
            'carnavalTuesday',
            'internationalWorkersDay',
            'dayOfTheDead',
            'christmasDay',
        ];

        if ($this->year >= Ecuador::BATTLE_OF_PICHINCHA_YEAR) {
            $holidays[] = 'battleOfPichinchaDay';
        }
        if ($this->year >= Ecuador::FIRST_CRY_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'firstCryOfIndependenceDay';
        }
        if ($this->year >= Ecuador::INDEPENDENCE_OF_GUAYAQUIL_YEAR) {
            $holidays[] = 'independenceOfGuayaquilDay';
        }
        if ($this->year >= Ecuador::INDEPENDENCE_OF_CUENCA_YEAR) {
            $holidays[] = 'independenceOfCuencaDay';
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

    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /** @throws \Exception */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 4);
    }
}
