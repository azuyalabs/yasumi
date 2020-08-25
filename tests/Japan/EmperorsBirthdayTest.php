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

namespace Yasumi\tests\Japan;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class testing the Emperors Birthday in Japan.
 */
class EmperorsBirthdayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'emperorsBirthday';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1949;
    // public const ESTABLISHMENT_YEAR = 1989;

    /**
     * Tests the Emperors Birthday after 1949 to 1988. The Emperors Birthday is on April 28rd and celebrated as such since
     * 1949.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testEmperorsBirthdayOnAfter1949(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1987);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-4-29", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the Emperors Birthday after 1989 to 2018. The Emperors Birthday is on December 23rd and celebrated as such since
     * 1989. Prior to the death of Emperor Hirohito in 1989, this holiday was celebrated on April 29. See also "Shōwa
     * Day".
     * @throws Exception
     * @throws ReflectionException
     */
    public function testEmperorsBirthdayOnAfter1989(): void
    {
        $year = $this->generateRandomYear(1989, 2018);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-12-23", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the Emperors Birthday after 2020. The Emperors Birthday is on February 23rd and celebrated as such since
     * 2020.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testEmperorsBirthdayOnAfter2020(): void
    {
        $year = $this->generateRandomYear(2020);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-2-23", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the Emperors Birthday after 1989 substituted next working day (when the Emperors Birthday falls on a
     * Sunday)
     * @throws Exception
     * @throws ReflectionException
     */
    public function testEmperorsBirthdayOnAfter1989SubstitutedNextWorkingDay(): void
    {
        $year = 2001;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-12-24", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the Emperors Birthday before 1989. The Emperors Birthday is on December 23rd and celebrated as such since
     * 1989. Prior to the death of Emperor Hirohito in 1989, this holiday was celebrated on April 29. See also "Shōwa
     * Day"/"Greenery Day"
     * @throws ReflectionException
     */
    public function testEmperorsBirthdayBefore1989(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the Emperors Birthday at 2019.
     *
     * @throws ReflectionException
     */
    public function testEmperorsBirthdayAt2019(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2019
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => '天皇誕生日']
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
