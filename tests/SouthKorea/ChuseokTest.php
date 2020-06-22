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
 * Class for testing Chuseok in South Korea.
 */
class ChuseokTest extends SouthKoreaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'chuseok';

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
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2050);
        if (isset(SouthKorea::LUNAR_HOLIDAY[self::HOLIDAY][$year])) {
            $date = new DateTime(SouthKorea::LUNAR_HOLIDAY[self::HOLIDAY][$year], new DateTimeZone(self::TIMEZONE));

            // Chuseok
            $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);

            // Day after Chuseok
            if ($year >= 1986) {
                $this->assertHoliday(
                    self::REGION,
                    'dayAfterChuseok',
                    $year,
                    (clone $date)->add(new DateInterval('P1D'))
                );
            }

            // Day before Chuseok
            if ($year >= 1989) {
                $this->assertHoliday(
                    self::REGION,
                    'dayBeforeChuseok',
                    $year,
                    (clone $date)->sub(new DateInterval('P1D'))
                );
            }
        }
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Gaecheonjeol).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSubstituteHolidayByGaecheonjeol(): void
    {
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:dayBeforeChuseok',
            2017,
            new DateTime('2017-10-6', new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:chuseok',
            2028,
            new DateTime('2028-10-5', new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:dayAfterChuseok',
            2039,
            new DateTime('2039-10-5', new DateTimeZone(self::TIMEZONE))
        );
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
            'substituteHoliday:dayBeforeChuseok',
            2014,
            new DateTime('2014-9-10', new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:chuseok',
            2039,
            new DateTime('2039-10-4', new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:dayAfterChuseok',
            2022,
            new DateTime('2022-9-12', new DateTimeZone(self::TIMEZONE))
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
                [self::LOCALE => '추석']
            );
            if ($year >= 1986) {
                $this->assertTranslatedHolidayName(
                    self::REGION,
                    'dayAfterChuseok',
                    $year,
                    [self::LOCALE => '추석 연휴']
                );
            }
            if ($year >= 1989) {
                $this->assertTranslatedHolidayName(
                    self::REGION,
                    'dayBeforeChuseok',
                    $year,
                    [self::LOCALE => '추석 연휴']
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
            if ($year >= 1986) {
                $this->assertHolidayType(
                    self::REGION,
                    'dayAfterChuseok',
                    $year,
                    Holiday::TYPE_OFFICIAL
                );
            }
            if ($year >= 1989) {
                $this->assertHolidayType(
                    self::REGION,
                    'dayBeforeChuseok',
                    $year,
                    Holiday::TYPE_OFFICIAL
                );
            }
        }
    }
}
