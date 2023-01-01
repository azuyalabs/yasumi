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

namespace Yasumi\tests\Switzerland\Valais;

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Corpus Christi in Valais (Switzerland).
 */
class CorpusChristiTest extends ValaisBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'corpusChristi';

    /**
     * Tests Corpus Christi.
     *
     * @throws \Exception
     */
    public function testCorpusChristi(): void
    {
        $year = 2016;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $this->calculateEaster($year, self::TIMEZONE)->add(new \DateInterval('P60D'))
        );
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
            [self::LOCALE => 'Fête-Dieu']
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
