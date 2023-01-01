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

namespace Yasumi\tests\Portugal;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

class PortugueseRepublicDayTest extends PortugalBaseTestCase implements HolidayTestCase
{
    public const ESTABLISHMENT_YEAR = 1910;

    public const HOLIDAY_YEAR_SUSPENDED = 2013;

    public const HOLIDAY_YEAR_RESTORED = 2016;

    public const HOLIDAY = 'portugueseRepublic';

    /**
     * @throws \Exception
     */
    public function testHolidayOnAfterRestoration(): void
    {
        foreach ($this->randomYearsOnAfterRestoration() as $year) {
            $this->assertHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new \DateTime("$year-10-05", new \DateTimeZone(self::TIMEZONE))
            );
        }
    }

    /**
     * @throws \Exception
     */
    public function testNotHolidayDuringAbolishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::HOLIDAY_YEAR_SUSPENDED, self::HOLIDAY_YEAR_RESTORED - 1)
        );
    }

    /**
     * @throws \Exception
     */
    public function testHolidayOnAfterEstablishment(): void
    {
        foreach ($this->randomYearsOnAfterEstablishment() as $year) {
            $this->assertHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new \DateTime("$year-10-05", new \DateTimeZone(self::TIMEZONE))
            );
        }
    }

    public function testHolidayBeforeEstablishment(): void
    {
        try {
            foreach ($this->randomYearsBeforeEstablishment() as $year) {
                $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
            }
        } catch (\Exception $e) {
        }
    }

    public function testTranslation(): void
    {
        try {
            foreach ($this->randomEstablishedYear() as $year) {
                $this->assertTranslatedHolidayName(
                    self::REGION,
                    self::HOLIDAY,
                    $year,
                    [self::LOCALE => 'Implantação da República Portuguesa']
                );
            }
        } catch (\Exception $e) {
        }
    }

    public function testHolidayType(): void
    {
        try {
            foreach ($this->randomEstablishedYear() as $year) {
                $this->assertHolidayType(
                    self::REGION,
                    self::HOLIDAY,
                    $year,
                    Holiday::TYPE_OFFICIAL
                );
            }
        } catch (\Exception $e) {
        }
    }

    /** @return \Generator<int>
     * @throws \Exception
     */
    private function randomEstablishedYear(): \Generator
    {
        yield $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::HOLIDAY_YEAR_SUSPENDED - 1);
        yield $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
    }

    /** @return \Generator<int>
     * @throws \Exception
     */
    private function randomYearsBeforeEstablishment(): \Generator
    {
        yield $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        yield self::ESTABLISHMENT_YEAR - 1;
    }

    /** @return \Generator<int>
     * @throws \Exception
     */
    private function randomYearsOnAfterEstablishment(): \Generator
    {
        yield $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        yield self::ESTABLISHMENT_YEAR;
    }

    /** @return \Generator<int>
     * @throws \Exception
     */
    private function randomYearsOnAfterRestoration(): \Generator
    {
        yield $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        yield self::HOLIDAY_YEAR_RESTORED;
    }
}
