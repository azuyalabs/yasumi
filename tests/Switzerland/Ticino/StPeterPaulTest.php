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

namespace Yasumi\tests\Switzerland\Ticino;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Feast of Saints Peter and Paul in Ticino (Switzerland).
 */
class StPeterPaulTest extends TicinoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'stPeterPaul';

    /**
     * Tests Feast of Saints Peter and Paul.
     *
     * @dataProvider StPeterPaulDataProvider
     *
     * @param int       $year     the year for which Feast of Saints Peter and Paul needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testStPeterPaul(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Feast of Saints Peter and Paul.
     *
     * @return array<array> list of test dates for Feast of Saints Peter and Paul
     *
     * @throws \Exception
     */
    public function StPeterPaulDataProvider(): array
    {
        return $this->generateRandomDates(6, 29, self::TIMEZONE);
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Santi Pietro e Paolo']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
