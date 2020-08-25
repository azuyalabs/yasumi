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

namespace Yasumi\tests\Estonia;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\Estonia;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Estonia's Victory day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class VictoryDayTest extends EstoniaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'victoryDay';

    /**
     * Test if holiday is not defined before
     * @throws ReflectionException
     */
    public function testHolidayBefore(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Estonia::VICTORY_DAY_START_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidayAfter(): void
    {
        $year = $this->generateRandomYear(Estonia::VICTORY_DAY_START_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("{$year}-06-23", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * {@inheritdoc}
     *
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::VICTORY_DAY_START_YEAR),
            [self::LOCALE => 'Võidupüha']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::VICTORY_DAY_START_YEAR),
            ['en' => 'Victory Day']
        );
    }

    /**
     * {@inheritdoc}
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::VICTORY_DAY_START_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
