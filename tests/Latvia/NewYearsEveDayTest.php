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

namespace Yasumi\tests\Latvia;

use DateTime;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for New Year's Eve day in Latvia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class NewYearsEveDayTest extends LatviaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'newYearsEve';

    /**
     * @return array
     * @throws Exception
     */
    public function holidayDataProvider(): array
    {
        return $this->generateRandomDates(12, 31, self::TIMEZONE);
    }

    /**
     * @dataProvider holidayDataProvider
     *
     * @param int $year
     * @param DateTime $expected
     *
     * @throws ReflectionException
     */
    public function testHoliday($year, DateTime $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * {@inheritdoc}
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Vecgada vakars', 'en' => 'New Year\'s Eve']
        );
    }

    /**
     * {@inheritdoc}
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
