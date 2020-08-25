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

namespace Yasumi\tests\Austria\Salzburg;

use DateTime;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Saint Rupert's Day in Salzburg (Austria).
 */
class StRupertsDayTest extends SalzburgBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'stRupertsDay';

    /**
     * Tests Saint Rupert's Day.
     *
     * @dataProvider StRupertsDayDataProvider
     *
     * @param int $year the year for which Saint Rupert's Day needs to be tested.
     * @param DateTime $expected the expected date.
     *
     * @throws ReflectionException
     */
    public function testStRupertsDay($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Saint Rupert's Day.
     *
     * @return array list of test dates for Saint Rupert's Day.
     * @throws Exception
     */
    public function StRupertsDayDataProvider(): array
    {
        return $this->generateRandomDates(9, 24, self::TIMEZONE);
    }

    /**
     * Tests translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Rupert']
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
