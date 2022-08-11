<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 * @author Bertrand Kintanar <bertrand dot kintanar at gmail dot com>
 */

namespace Yasumi\tests\Cyprus;

use DateTime;
use DateTimeZone;
use Exception;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Christmas day in the Cyprus.
 *
 * Class GreenMondayTest
 *
 * @author  Dennis Fridrich <fridrich.dennis@gmail.com>
 */
class GreenMondayTest extends CyprusBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'greenMonday';

    /**
     * Tests Green Monday.
     */
    public function testGreenMonday(): void
    {
        $year = 2022;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-03-07", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of Green Monday.
     *
     * @throws Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Green Monday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
