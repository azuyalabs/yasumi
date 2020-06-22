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

namespace Yasumi\tests\USA;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class to test Washington's Birthday.
 */
class WashingtonsBirthdayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'washingtonsBirthday';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1879;

    /**
     * Tests Washington's Birthday on or after 1968. Washington's Birthday was established since 1879 on February 22
     * and was changed in 1968 to the third Monday in February.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testWashingtonsBirthdayOnAfter1968(): void
    {
        $year = $this->generateRandomYear(1968);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("third monday of february $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Washington's Birthday between 1879 and 1967. Washington's Birthday was established since 1879 on February
     * 22 and was changed in 1968 to the third Monday in February.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testWashingtonsBirthdayBetween1879And1967(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1967);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-2-22", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Washington's Birthday before 1879. Washington's Birthday was established since 1879 on February 22 and was
     * changed in 1968 to the third Monday in February.
     * @throws ReflectionException
     */
    public function testWashingtonsBirthdayBefore1879(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Washington’s Birthday']
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
