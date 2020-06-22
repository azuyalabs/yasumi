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

namespace Yasumi\tests\Portugal;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\Portugal;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Portugal Day in Portugal.
 */
class PortugalDayTest extends PortugalBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The year in which the holiday was abolished
     */
    public const ESTABLISHMENT_YEAR_BEFORE = 1932;

    /**
     * The year in which the holiday was restored
     */
    public const ESTABLISHMENT_YEAR_AFTER = 1974;

    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'portugalDay';

    /**
     * Tests the holiday defined in this test before it was abolished.
     * @throws ReflectionException
     * @throws Exception
     * @see Portugal::calculatePortugalDay()
     */
    public function testHolidayBeforeAbolishment(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR_BEFORE);
        $expected = new DateTime("$year-06-10", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests the holiday defined in this test after it was restored
     * @throws ReflectionException
     * @throws Exception
     * @see Portugal::calculatePortugalDay()
     */
    public function testHolidayAfterRestoration(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR_AFTER);
        $expected = new DateTime("$year-06-10", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests that the holiday defined in this test does not exist during the period that it was abolished
     * @throws ReflectionException
     * @see Portugal::calculatePortugalDay()
     *
     */
    public function testNotHolidayDuringAbolishment(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR_BEFORE + 1, self::ESTABLISHMENT_YEAR_AFTER - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);

        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR_BEFORE + 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR_AFTER - 1);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR_BEFORE);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Dia de Portugal']);

        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR_AFTER);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Dia de Portugal']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR_BEFORE);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);

        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR_AFTER);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
