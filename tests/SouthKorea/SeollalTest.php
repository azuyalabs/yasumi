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

use DateInterval;
use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\SouthKorea;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Seollal (Korean New Year's Day) in South Korea.
 */
class SeollalTest extends SouthKoreaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'seollal';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1985;

    /**
     * Tests the holiday defined in this test.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2050);
        if (isset(SouthKorea::LUNAR_HOLIDAY[self::HOLIDAY][$year])) {
            $date = new DateTime(SouthKorea::LUNAR_HOLIDAY[self::HOLIDAY][$year], new DateTimeZone(self::TIMEZONE));

            // Seollal
            $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);

            if ($year >= 1990) {
                // Day before Seollal
                $this->assertHoliday(
                    self::REGION,
                    'dayBeforeSeollal',
                    $year,
                    (clone $date)->sub(new DateInterval('P1D'))
                );

                // Day after Seollal
                $this->assertHoliday(
                    self::REGION,
                    'dayAfterSeollal',
                    $year,
                    (clone $date)->add(new DateInterval('P1D'))
                );
            }
        }
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Sunday).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSubstituteHolidayBySunday(): void
    {
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:dayBeforeSeollal',
            2016,
            new DateTime('2016-2-10', new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:seollal',
            2034,
            new DateTime('2034-2-21', new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:dayAfterSeollal',
            2024,
            new DateTime('2024-2-12', new DateTimeZone(self::TIMEZONE))
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
     * Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2050);
        if (isset(SouthKorea::LUNAR_HOLIDAY[self::HOLIDAY][$year])) {
            $this->assertTranslatedHolidayName(
                self::REGION,
                self::HOLIDAY,
                $year,
                [self::LOCALE => '설날']
            );
            if ($year >= 1990) {
                $this->assertHolidayType(
                    self::REGION,
                    'dayBeforeSeollal',
                    $year,
                    Holiday::TYPE_OFFICIAL
                );
                $this->assertHolidayType(
                    self::REGION,
                    'dayAfterSeollal',
                    $year,
                    Holiday::TYPE_OFFICIAL
                );
            }
        }
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2050);
        if (isset(SouthKorea::LUNAR_HOLIDAY[self::HOLIDAY][$year])) {
            $this->assertHolidayType(
                self::REGION,
                self::HOLIDAY,
                $year,
                Holiday::TYPE_OFFICIAL
            );
            if ($year >= 1990) {
                $this->assertHolidayType(
                    self::REGION,
                    'dayBeforeSeollal',
                    $year,
                    Holiday::TYPE_OFFICIAL
                );
                $this->assertHolidayType(
                    self::REGION,
                    'dayAfterSeollal',
                    $year,
                    Holiday::TYPE_OFFICIAL
                );
            }
        }
    }
}
