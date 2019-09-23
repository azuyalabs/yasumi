<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\UnitedKingdom\NorthernIreland;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the May Day Bank Holiday in Northern Ireland.
 */
class MayDayBankHolidayTest extends NorthernIrelandBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'mayDayBankHoliday';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1978;

    /**
     * Tests the holiday defined in this test.
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function testHoliday()
    {
        $year = 2101;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-5-2", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday exception in 1995 and 2020.
     * @throws \ReflectionException
     */
    public function testHolidayExceptions()
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            1995,
            new DateTime('1995-5-8', new DateTimeZone(self::TIMEZONE))
        );

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2020,
            new DateTime('2020-5-8', new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday defined in this test before establishment.
     * @throws \ReflectionException
     */
    public function testHolidayBeforeEstablishment()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * @throws \ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'May Day Bank Holiday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws \ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_BANK
        );
    }
}
