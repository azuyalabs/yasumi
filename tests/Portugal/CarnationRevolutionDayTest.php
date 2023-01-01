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

/**
 * Class for testing Portugal Day in Portugal.
 */
class CarnationRevolutionDayTest extends PortugalBaseTestCase implements HolidayTestCase
{
    /**
     * The year in which the holiday was established.
     */
    public const ESTABLISHMENT_YEAR = 1974;

    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = '25thApril';

    /**
     * Test that the holiday is valid after the year of establishment.
     *
     * @throws \Exception
     */
    public function testHolidayAfterEstablishment(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $expected = new \DateTime("$year-04-25", new \DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests that the holiday is not a holiday before the year of establishment.
     *
     * @throws \Exception
     */
    public function testNotHolidayBeforeEstablishment(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Dia da Liberdade']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
