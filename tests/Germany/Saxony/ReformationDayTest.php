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

namespace Yasumi\tests\Germany\Saxony;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Reformation Day in Saxony (Germany).
 */
class ReformationDayTest extends SaxonyBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'reformationDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1517;

    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int $year the year for which the holiday defined in this test needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testHoliday($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test
     *
     * @return array list of test dates for the holiday defined in this test
     * @throws Exception
     */
    public function HolidayDataProvider(): array
    {
        $data = [];

        for ($y = 0; $y < self::TEST_ITERATIONS; $y++) {
            $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
            $data[] = [$year, new DateTime("$year-10-31", new DateTimeZone(self::TIMEZONE))];
        }

        return $data;
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
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Reformationstag']
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
            Holiday::TYPE_OFFICIAL
        );
    }
}
