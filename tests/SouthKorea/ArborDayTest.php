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

namespace Yasumi\tests\SouthKorea;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing day after Arbor Day in South Korea.
 */
class ArborDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The year in which the holiday was removed.
     */
    public const REMOVED_YEAR = 2005;

    /**
     * The year the date was temporarily changed.
     */
    public const TEMPORARY_CHANGED_YEAR = 1960;
    /**
     * The name of the holiday.
     */
    private const HOLIDAY = 'arborDay';

    /**
     * The year in which the holiday was first established.
     */
    private const ESTABLISHMENT_YEAR = 1949;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::REMOVED_YEAR);
        $date = (self::TEMPORARY_CHANGED_YEAR === $year)
            ? new \DateTime("{$year}-3-21", new \DateTimeZone(self::TIMEZONE))
            : new \DateTime("{$year}-4-5", new \DateTimeZone(self::TIMEZONE));

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $date
        );
    }

    /**
     * Tests the holiday defined in this test after removal.
     *
     * @throws \Exception
     */
    public function testHolidayAfterRemoval(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::REMOVED_YEAR + 1)
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
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::REMOVED_YEAR);
        $translation = (self::TEMPORARY_CHANGED_YEAR === $year) ? '사방의 날' : '식목일';

        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => $translation]
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::REMOVED_YEAR);
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $year,
            Holiday::TYPE_OFFICIAL
        );
    }
}
