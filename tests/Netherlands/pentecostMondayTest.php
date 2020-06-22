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

namespace Yasumi\tests\Netherlands;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Pentecost in the Netherlands.
 */
class pentecostMondayTest extends NetherlandsBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'pentecostMonday';

    /**
     * Tests Pentecost Monday.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testPentecostMonday(): void
    {
        $year = 2020;
        $this->assertHoliday(
            self::REGION,
            'pentecostMonday',
            $year,
            new DateTime("$year-6-1", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'tweede pinksterdag']
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
