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

namespace Yasumi\tests\Germany;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the children's day in Germany.
 */
class ChildrensDayTest extends GermanyBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'childrensDay';

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \ReflectionException
     */
    public function testHoliday()
    {
        $year = $this->generateRandomYear(1954);
        $expectedDate = new DateTime("$year-9-20", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expectedDate);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * @throws \ReflectionException
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1954),
            [self::LOCALE => 'Kindertag']
        );
    }

    /**
     * Tests type of the holiday defined in this tests.
     * @throws \ReflectionException
     */
    public function testHolidayType()
    {
        $year = $this->generateRandomYear(1954);

        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $year,
            Holiday::TYPE_OTHER
        );
    }
}
