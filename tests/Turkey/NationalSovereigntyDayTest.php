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

namespace Yasumi\tests\Turkey;

use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;
use Yasumi\Yasumi;

class NationalSovereigntyDayTest extends TurkeyBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'nationalSovereigntyDay';

    // National Sovereignty Day was declared a national holiday on May 1st, 1921, thus celebrating from 1922.
    public const ESTABLISHMENT_YEAR = 1922;

    // In 1981 this day was officially named 'Ulusal Egemenlik ve Çocuk Bayramı'
    public const NAME_CHANGED_YEAR = 1981;

    /**
     * @throws ReflectionException
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Yasumi::YEAR_LOWER_BOUND, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * @throws ReflectionException
     * @throws \Exception
     */
    public function testHolidayOnAfterEstablishment(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-4-23", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::NAME_CHANGED_YEAR - 1),
            [self::LOCALE => 'Ulusal Egemenlik Bayramı']
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testTranslationOnAfterNameChange(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::NAME_CHANGED_YEAR),
            [self::LOCALE => 'Ulusal Egemenlik ve Çocuk Bayramı']
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
