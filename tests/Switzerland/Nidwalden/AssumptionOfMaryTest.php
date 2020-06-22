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

namespace Yasumi\tests\Switzerland\Nidwalden;

use DateTime;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the day of the Assumption of Mary in Nidwalden (Switzerland).
 */
class AssumptionOfMaryTest extends NidwaldenBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'assumptionOfMary';

    /**
     * Tests the day of the Assumption of Mary.
     *
     * @dataProvider AssumptionOfMaryDataProvider
     *
     * @param int $year the year for which the day of the Assumption of Mary needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testAssumptionOfMary($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests translated name of the day of the Assumption of Mary.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Mariä Himmelfahrt']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }

    /**
     * Returns a list of random test dates used for assertion of the day of the Assumption of Mary.
     *
     * @return array list of test dates for the day of the Assumption of Mary
     * @throws Exception
     */
    public function AssumptionOfMaryDataProvider(): array
    {
        return $this->generateRandomDates(8, 15, self::TIMEZONE);
    }
}
