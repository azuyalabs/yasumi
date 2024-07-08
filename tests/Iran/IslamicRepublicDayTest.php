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
use Yasumi\tests\HolidayTestCase;
use Yasumi\Yasumi;

class IslamicRepublicDayTest extends IranBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'islamicRepublicDay';

    public const ESTABLISHMENT_YEAR = 1979;

    public const EQUINOX_YEAR = 2016;

    /**
     * @throws \Exception
     */
    public function testIslamicRepublicDayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Yasumi::YEAR_LOWER_BOUND, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * @throws \Exception
     */
    public function testIslamicRepublicDayBeforeEquinoxYear(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::EQUINOX_YEAR - 1);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-04-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @throws \Exception
     */
    public function testIslamicRepublicDayOnEquinoxYear(): void
    {
        $year = $this->generateRandomYear(self::EQUINOX_YEAR, self::EQUINOX_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-03-31", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @throws \Exception
     */
    public function testIslamicRepublicDayAfterEquinoxYear(): void
    {
        $year = $this->generateRandomYear(self::EQUINOX_YEAR + 1);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-04-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::EQUINOX_YEAR),
            [
                self::LOCALE => 'روز جمهوری اسلامی',
                'en' => 'Ruz e Jomhuri ye Eslami',
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::EQUINOX_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
