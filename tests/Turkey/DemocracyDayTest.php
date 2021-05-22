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

class DemocracyDayTest extends TurkeyBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'democracyDay';

    public const ESTABLISHMENT_YEAR = 2017;

    /**
     * @throws ReflectionException
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-7-15", new \DateTimeZone(self::TIMEZONE))
        );
    }

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
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Demokrasi ve Millî Birlik Günü']
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
