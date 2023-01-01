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

namespace Yasumi\tests\Argentina;

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Carnaval Monday in Argentina.
 */
class CarnavalMondayTest extends ArgentinaBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'carnavalMonday';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1700;

    /**
     * Tests Carnaval Monday on or after 1700.
     *
     * @throws \Exception
     */
    public function testCarnavalMondayAfter1700(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $this->calculateEaster($year, self::TIMEZONE)->sub(new \DateInterval('P48D'))
        );
    }

    /**
     * Tests Carnaval Monday on or before 1700.
     *
     * @throws \Exception
     */
    public function testCarnavalMondayBefore1700(): void
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
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Lunes de Carnaval']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OBSERVANCE);
    }
}
