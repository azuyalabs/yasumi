<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Portugal;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

class PortugueseRepublicDayTest extends PortugalBaseTestCase implements HolidayTestCase
{
    public const ESTABLISHMENT_YEAR = 1910;

    public const HOLIDAY_YEAR_SUSPENDED = 2013;

    public const HOLIDAY_YEAR_RESTORED = 2016;

    public const HOLIDAY = 'portugueseRepublic';

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHolidayOnAfterRestoration(): void
    {
        foreach (function () {
            yield $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
            yield self::HOLIDAY_YEAR_RESTORED;
        } as $year) {
            $this->assertHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new DateTime("$year-10-05", new DateTimeZone(self::TIMEZONE))
            );
        }
    }

    /**
     * @throws ReflectionException
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
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHolidayOnAfterEstablishment(): void
    {
        foreach (function () {
            yield $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
            yield self::ESTABLISHMENT_YEAR;
        } as $year) {
            $this->assertHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new DateTime("$year-10-05", new DateTimeZone(self::TIMEZONE))
            );
        }
    }

    /**
     * @throws ReflectionException
     */
    public function testHolidayBeforeEstablishment(): void
    {
        foreach (function () {
            yield $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
            yield self::ESTABLISHMENT_YEAR - 1;
        } as $year) {
            $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
        }
    }

    /**
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        foreach ($this->randomEstablishedYear() as $year) {
            $this->assertTranslatedHolidayName(
                self::REGION,
                self::HOLIDAY,
                $year,
                [self::LOCALE => 'Implantação da República Portuguesa']
            );
        }
    }

    /**
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        foreach ($this->randomEstablishedYear() as $year) {
            $this->assertHolidayType(
                self::REGION,
                self::HOLIDAY,
                $year,
                Holiday::TYPE_OFFICIAL
            );
        }
    }

    private function randomEstablishedYear(): \Generator
    {
        yield $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::HOLIDAY_YEAR_SUSPENDED - 1);
        yield $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
    }
}
