<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\UnitedKingdom\England;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the Summer Bank Holiday England.
 */
class SummerBankHolidayTest extends EnglandBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'summerBankHoliday';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1871;

    /**
     * The year in which the holiday was renamed from August Bank Holiday to Summer Bank Holiday.
     */
    public const RENAME_YEAR = 1965;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(1970);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("last monday of august $year", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday exception in 2020.
     *
     * @throws \Exception
     */
    public function testHolidayBefore1965(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1964);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("first monday of august $year", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday during trial period in 1965-1970.
     *
     * @throws \Exception
     */
    public function testHolidayTrialPeriod(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            1965,
            new \DateTime('1965-8-30', new \DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            1966,
            new \DateTime('1966-8-29', new \DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            1967,
            new \DateTime('1967-8-28', new \DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            1968,
            new \DateTime('1968-9-2', new \DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            1969,
            new \DateTime('1969-9-1', new \DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            1970,
            new \DateTime('1970-8-31', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday defined in this test before establishment.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::RENAME_YEAR),
            [self::LOCALE => 'Summer Bank Holiday']
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslationBeforeRename(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::RENAME_YEAR - 1),
            [self::LOCALE => 'August Bank Holiday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_BANK
        );
    }
}
