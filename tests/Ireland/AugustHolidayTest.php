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

namespace Yasumi\tests\Ireland;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the August Holiday in Ireland.
 */
class AugustHolidayTest extends IrelandBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'augustHoliday';

    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int $year the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHoliday($year, $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime($expected, new DateTimeZone(self::TIMEZONE))
        );
        $this->assertDayOfWeek(self::REGION, self::HOLIDAY, $year, 'Monday');
    }

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     * @throws Exception
     */
    public function HolidayDataProvider(): array
    {
        $data = [];

        for ($y = 0; $y < self::TEST_ITERATIONS; $y++) {
            $year = $this->generateRandomYear();
            $date = new DateTime("next monday $year-7-31", new DateTimeZone(self::TIMEZONE));

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'August Holiday']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            ['ga_IE' => 'Lá Saoire i mí Lúnasa']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
