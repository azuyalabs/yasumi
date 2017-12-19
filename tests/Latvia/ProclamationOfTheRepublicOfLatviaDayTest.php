<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Latvia;

use Yasumi\Holiday;
use Yasumi\Provider\Latvia;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Restoration of Independence of Latvia day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class ProclamationOfTheRepublicOfLatviaDayTest extends LatviaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'proclamationOfTheRepublicOfLatviaDay';

    /**
     * Test if holiday is not defined before proclamation
     */
    public function testNotHoliday()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Latvia::PROCLAMATION_OF_INDEPENDENCE_YEAR - 1)
        );
    }

    /**
     * @return array
     */
    public function holidayDataProvider()
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
     * Test defined holiday in the test
     *
     * @dataProvider holidayDataProvider
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * {@inheritdoc}
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Latvia::PROCLAMATION_OF_INDEPENDENCE_YEAR),
            [
                self::LOCALE => 'Latvijas Republikas proklamēšanas diena',
                'en_US' => 'Proclamation Day of the Republic of Latvia'
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Latvia::PROCLAMATION_OF_INDEPENDENCE_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
