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
use Yasumi\tests\ProviderTestCase;
use Yasumi\Yasumi;

/**
 * Class for testing holidays in Benin.
 */
class BeninTest extends BeninBaseTestCase implements ProviderTestCase
{
    /** @var int year random year number used for all tests in this Test Case */
    protected int $year;

    /**
     * Initial setup of this Test Case.
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->year = static::generateRandomYear(Benin::ESTABLISHMENT_YEAR);
    }

    /**
     * Tests if all official holidays in Benin are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'easterMonday',
            'internationalWorkersDay',
            'ascensionDay',
            'pentecostMonday',
            'nationalDay',
            'assumptionOfMary',
            'allSaintsDay',
            'christmasDay',
        ];

        if ($this->year >= 1998) {
            $holidays[] = 'traditionalReligionsDay';
        }

        if ($this->year >= 2025) {
            $holidays[] = 'traditionalReligionsDayEve';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Benin are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays(
            ['remembranceDay', 'peoplesSovereigntyDay', 'internationalWomensDay'],
            self::REGION,
            $this->year,
            Holiday::TYPE_OBSERVANCE
        );
    }

    /**
     * Tests if all seasonal holidays in Benin are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Benin are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Benin are defined by the provider class.
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * Tests that no holidays are defined before the establishment year.
     *
     * @throws \Exception
     */
    public function testNoHolidaysBeforeEstablishment(): void
    {
        self::assertCount(0, Yasumi::create(self::REGION, Benin::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests the exact set of holidays in the years where the rules change.
     *
     * @param int           $year     the year to be tested
     * @param array<string> $official the keys of the expected official holidays
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('BoundaryYearsDataProvider')]
    public function testHolidaysInBoundaryYears(int $year, array $official): void
    {
        $holidays = Yasumi::create(self::REGION, $year);

        $keysOfType = static function (string $type) use ($holidays): array {
            $keys = array_keys(array_filter(
                $holidays->getHolidays(),
                static fn (Holiday $holiday): bool => $type === $holiday->getType()
            ));
            sort($keys);

            return $keys;
        };

        sort($official);

        self::assertSame($official, $keysOfType(Holiday::TYPE_OFFICIAL));
        self::assertSame(
            ['internationalWomensDay', 'peoplesSovereigntyDay', 'remembranceDay'],
            $keysOfType(Holiday::TYPE_OBSERVANCE)
        );
        self::assertCount(\count($official) + 3, $holidays);
    }

    /**
     * Returns the expected official holidays in the years where the rules change.
     *
     * @return array<array{int, array<string>}>
     */
    public static function BoundaryYearsDataProvider(): array
    {
        $holidays = [
            'newYearsDay',
            'easterMonday',
            'internationalWorkersDay',
            'ascensionDay',
            'pentecostMonday',
            'nationalDay',
            'assumptionOfMary',
            'allSaintsDay',
            'christmasDay',
        ];

        return [
            [1991, $holidays],
            [1997, $holidays],
            [1998, [...$holidays, 'traditionalReligionsDay']],
            [2024, [...$holidays, 'traditionalReligionsDay']],
            [2025, [...$holidays, 'traditionalReligionsDay', 'traditionalReligionsDayEve']],
        ];
    }

    /** @throws \Exception */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 4);
    }
}
