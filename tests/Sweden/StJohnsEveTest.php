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

namespace Yasumi\tests\Sweden;

use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Yasumi;

/**
 * Class for testing St. John's Eve / Midsummer's Eve in Sweden.
 */
class StJohnsEveTest extends SwedenBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'stJohnsEve';

    /**
     * Tests the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear();

        $holidays = Yasumi::create(self::REGION, $year);
        $holiday = $holidays->getHoliday(self::HOLIDAY);

        // Some basic assertions
        $this->assertInstanceOf(Holiday::class, $holiday);
        $this->assertNotNull($holiday);

        // Holiday specific assertions
        $this->assertEquals('Friday', $holiday->format('l'));
        $this->assertGreaterThanOrEqual(19, $holiday->format('j'));
        $this->assertLessThanOrEqual(25, $holiday->format('j'));

        unset($holiday, $holidays);
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
            $this->generateRandomYear(),
            [self::LOCALE => 'midsommarafton']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }
}
