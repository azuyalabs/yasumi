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
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\Latvia;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Restoration of Independence of Latvia day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class RestorationOfIndependenceDayTest extends LatviaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'restorationOfIndependenceOfLatviaDay';

    /**
     * Test if holiday is not defined before restoration
     * @throws ReflectionException
     */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Latvia::RESTORATION_OF_INDEPENDENCE_YEAR - 1)
        );
    }

    /**
     * @return array
     * @throws Exception
     */
    public function holidayDataProvider(): array
    {
        return $this->generateRandomDatesWithHolidayMovedToMonday(
            5,
            4,
            self::TIMEZONE,
            10,
            Latvia::RESTORATION_OF_INDEPENDENCE_YEAR
        );
    }

    /**
     * Test defined holiday in the test
     *
     * @dataProvider holidayDataProvider
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
            $this->generateRandomYear(Latvia::RESTORATION_OF_INDEPENDENCE_YEAR),
            [
                self::LOCALE => 'Latvijas Republikas Neatkarības atjaunošanas diena',
                'en' => 'Restoration of Independence day',
            ]
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
            $this->generateRandomYear(Latvia::RESTORATION_OF_INDEPENDENCE_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
