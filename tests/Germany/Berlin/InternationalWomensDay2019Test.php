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

namespace Yasumi\tests\Germany\Berlin;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Reformation Day in Germany.
 */
class InternationalWomensDay2019Test extends BerlinBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'internationalWomensDay';

    /**
     * The year in which the holiday was established.
     */
    public const ESTABLISHMENT_YEAR = 2019;

    /**
     * Test the holiday defined in this test upon establishment.
     *
     * @throws \Exception
     */
    public function testHolidayOnEstablishment(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            self::ESTABLISHMENT_YEAR,
            new \DateTime(self::ESTABLISHMENT_YEAR.'-03-08', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Test the holiday defined in this test before establishment.
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
     * Test the holiday defined in this test after completion.
     *
     * @throws \Exception
     */
    public function testHolidayAfterCompletion(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(1900, self::ESTABLISHMENT_YEAR - 1));
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Internationaler Frauentag']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
