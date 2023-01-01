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

namespace Yasumi\tests\Switzerland\Geneva;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Restauration Genevoise in Geneva (Switzerland).
 */
class RestaurationGenevoiseTest extends GenevaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'restaurationGenevoise';

    /**
     * Tests Restauration Genevoise.
     *
     * @throws \Exception
     */
    public function testRestaurationGenevoiseAfter1813(): void
    {
        $year = $this->generateRandomYear(1814);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($year.'-12-31', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of Restauration Genevoise.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1814),
            [self::LOCALE => 'Restauration de la République']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1814), Holiday::TYPE_OTHER);
    }
}
