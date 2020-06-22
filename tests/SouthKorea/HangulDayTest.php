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

namespace Yasumi\tests\SouthKorea;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Hangul Day in South Korea.
 */
class HangulDayTest extends SouthKoreaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'hangulDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1949;

    /**
     * Tests the holiday defined in this test.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        if ($year > 1990 && $year <= 2012) {
            $this->assertNotHoliday(
                self::REGION,
                self::HOLIDAY,
                $year
            );
        } else {
            $this->assertHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new DateTime("$year-10-9", new DateTimeZone(self::TIMEZONE))
            );
        }
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
     * Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        if ($year <= 1990 || $year > 2012) {
            $this->assertTranslatedHolidayName(
                self::REGION,
                self::HOLIDAY,
                $year,
                [self::LOCALE => '한글날']
            );
        }
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        if ($year <= 1990 || $year > 2012) {
            $this->assertHolidayType(
                self::REGION,
                self::HOLIDAY,
                $year,
                Holiday::TYPE_OFFICIAL
            );
        }
    }
}
