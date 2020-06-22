<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\SouthAfrica;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the 2016 Substitute Day of Goodwill in South Africa.
 *
 * Note: South Africa has 12 public holidays as determined by the Public Holidays Act (Act No 36 of 1994). The Act
 * determines whenever any public holiday falls on a Sunday, the Monday following on it shall be a public holiday.
 * Yasumi currently implements all South African holidays based on this act.
 */
class SubstituteDayOfGoodwillTest extends SouthAfricaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'substituteDayOfGoodwill';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 2016;

    /**
     * Tests the holiday defined in this test on or after establishment.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidayOnAfterEstablishment(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            self::ESTABLISHMENT_YEAR,
            new DateTime(self::ESTABLISHMENT_YEAR . '-12-27', new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday defined in this test before establishment.
     * @throws ReflectionException
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
     * Tests the holiday defined in this test after completion.
     * @throws ReflectionException
     */
    public function testHolidayDayAfterCompletion(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR + 1));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Day of Goodwill observed']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
