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

namespace Yasumi\tests\Austria\UpperAustria;

use DateTime;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Saint Florian's Day in Upper Austria (Austria).
 */
class StFloriansDayTest extends UpperAustriaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'stFloriansDay';

    /**
     * Tests Saint Florian's Day.
     *
     * @dataProvider StFloriansDayDataProvider
     *
     * @param int $year the year for which Saint Florian's Day needs to be tested.
     * @param DateTime $expected the expected date.
     *
     * @throws ReflectionException
     */
    public function testStFloriansDay($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Saint Florian's Day.
     *
     * @return array list of test dates for Saint Florian's Day.
     * @throws Exception
     */
    public function StFloriansDayDataProvider(): array
    {
        return $this->generateRandomDates(5, 4, self::TIMEZONE);
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
            [self::LOCALE => 'Florian']
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
