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

namespace Yasumi\tests\Germany\Saxony;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Repentance And Prayer Day in Saxony (Germany).
 *
 * Note: All German states agreed, except of the Free State of Saxony, which chose instead a higher charge on labour
 * revenues, so that only there Buß- und Bettag remained a statutory non-working holiday as of 1995.
 * Buß- und Bettag has undergone many changes as either a working or non-working holiday in Germany. At the moment,
 * Yasumi only considers (for now) the time it was established as non-working day in Saxony.
 */
class RepentanceAndPrayerDayTest extends SaxonyBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'repentanceAndPrayerDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1995;

    /**
     * Tests the holiday defined in this test on or after establishment.
     *
     * @throws \Exception
     */
    public function testHolidayOnAfterEstablishment(): void
    {
        // Check between the 16th and 22nd day the one that is a Wednesday
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $holiday = new \DateTime("next wednesday $year-11-15", new \DateTimeZone(self::TIMEZONE)); // Default date

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $holiday);

        // Holiday specific assertions
        self::assertEquals('Wednesday', $holiday->format('l'));
        self::assertGreaterThanOrEqual(16, $holiday->format('j'));
        self::assertLessThanOrEqual(22, $holiday->format('j'));
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Buß- und Bettag']
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
            Holiday::TYPE_OFFICIAL
        );
    }
}
