<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Latvia;

use Yasumi\Holiday;
use Yasumi\Provider\Latvia;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Restoration of Independence of Latvia day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class ProclamationOfTheRepublicOfLatviaDayTest extends LatviaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'proclamationOfTheRepublicOfLatviaDay';

    /**
     * Test if holiday is not defined before proclamation.
     *
     * @throws \Exception
     */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Latvia::PROCLAMATION_OF_INDEPENDENCE_YEAR - 1)
        );
    }

    /**
     * @return array<array> list of test dates for the holiday defined in this test
     *
     * @throws \Exception
     */
    public function holidayDataProvider(): array
    {
        return $this->generateRandomDatesWithHolidayMovedToMonday(
            11,
            18,
            self::TIMEZONE,
            10,
            Latvia::PROCLAMATION_OF_INDEPENDENCE_YEAR
        );
    }

    /**
     * Test defined holiday in the test.
     *
     * @dataProvider holidayDataProvider
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     *
     * @throws \Exception
     */
    public function testHoliday(int $year, string $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Latvia::PROCLAMATION_OF_INDEPENDENCE_YEAR),
            [
                self::LOCALE => 'Latvijas Republikas proklamēšanas diena',
                'en' => 'Proclamation Day of the Republic of Latvia',
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Latvia::PROCLAMATION_OF_INDEPENDENCE_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
