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

namespace Yasumi\tests\Switzerland\Glarus;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Näfelser Fahrt in Glarus (Switzerland).
 */
class NafelserFahrtTest extends GlarusBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'nafelserFahrt';

    /**
     * The year in which the holiday was established
     */
    public const ESTABLISHMENT_YEAR = 1389;

    /**
     * Tests Näfelser Fahrt on or after 1389
     * @throws ReflectionException
     * @throws Exception
     */
    public function testNafelserFahrtOnAfter1389(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $date = new DateTime('First Thursday of ' . $year . '-04', new DateTimeZone(self::TIMEZONE));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
    }

    /**
     * Tests Näfelser Fahrt before 1389
     * @throws ReflectionException
     */
    public function testNafelserFahrtBefore1389(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Näfelser Fahrt.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Näfelser Fahrt']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OTHER
        );
    }
}
