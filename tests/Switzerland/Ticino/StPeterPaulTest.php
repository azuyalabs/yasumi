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

namespace Yasumi\tests\Switzerland\Ticino;

use DateTime;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Feast of Saints Peter and Paul in Ticino (Switzerland).
 */
class StPeterPaulTest extends TicinoBaseTestCase implements YasumiTestCaseInterface
{

    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'stPeterPaul';

    /**
     * Tests Feast of Saints Peter and Paul.
     *
     * @dataProvider StPeterPaulDataProvider
     *
     * @param int $year the year for which Feast of Saints Peter and Paul needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws ReflectionException
     */
    public function testStPeterPaul($year, $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Feast of Saints Peter and Paul.
     *
     * @return array list of test dates for Feast of Saints Peter and Paul
     * @throws Exception
     */
    public function StPeterPaulDataProvider(): array
    {
        return $this->generateRandomDates(6, 29, self::TIMEZONE);
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
            [self::LOCALE => 'Santi Pietro e Paolo']
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
}
