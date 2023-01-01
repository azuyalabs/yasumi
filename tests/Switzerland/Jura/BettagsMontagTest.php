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

namespace Yasumi\tests\Switzerland\Jura;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Bettags Montag in Jura (Switzerland).
 */
class BettagsMontagTest extends JuraBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'bettagsMontag';

    /**
     * Tests Bettags Montag on or after 1832.
     *
     * @throws \Exception
     */
    public function testBettagsMontagOnAfter1832(): void
    {
        $year = $this->generateRandomYear(1832);

        // Find third Sunday of September
        $date = new \DateTime('Third Sunday of '.$year.'-09', new \DateTimeZone(self::TIMEZONE));
        // Go to next Thursday
        $date->add(new \DateInterval('P1D'));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
    }

    /**
     * Tests Bettags Montag before 1832.
     *
     * @throws \Exception
     */
    public function testBettagsMontagBefore1832(): void
    {
        $year = $this->generateRandomYear(1000, 1831);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Bettags Montag.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1832),
            [self::LOCALE => 'Jeûne fédéral']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1900), Holiday::TYPE_OTHER);
    }
}
