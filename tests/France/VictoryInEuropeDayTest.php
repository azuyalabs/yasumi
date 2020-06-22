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

namespace Yasumi\tests\France;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Victory in Europe Day in France.
 */
class VictoryInEuropeDayTest extends FranceBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'victoryInEuropeDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1945;

    /**
     * Tests Victory In Europe Day on or after 1945.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testVictoryInEuropeDayOnAfter1945(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-5-8", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Victory In Europe Day before 1945.
     * @throws ReflectionException
     */
    public function testVictoryInEuropeDayBefore1945(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of Victory in Europe Day.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Victoire 1945']
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
