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
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Corpus Christi in Portugal.
 */
class CorpusChristiTest extends PortugalBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'corpusChristi';

    /**
     * Holiday was abolished by the portuguese government in 2014.
     */
    public const HOLIDAY_YEAR_ABOLISHED = 2013;

    /**
     * Holiday was restored by the portuguese government in 2016.
     */
    public const HOLIDAY_YEAR_RESTORED = 2016;

    /**
     * Tests the holiday defined in this test.
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHoliday(): void
    {
        $year = 2016;
        $expected = new DateTime("$year-5-26", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Test that the holiday did not happen in 2013-2015.
     * @throws ReflectionException
     */
    public function testNotHoliday(): void
    {
        $year = $this->generateRandomYear(2013, 2015);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Corpus Christi.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Corpo de Deus']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        // Before abolishment
        $year = $this->generateRandomYear(1000, self::HOLIDAY_YEAR_ABOLISHED - 1);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);

        // After restoration
        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }
}
