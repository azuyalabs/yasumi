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
 * Class testing the Emperors Coronation day in Japan.
 */
class EnthronementProclamationCeremonyTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'enthronementProclamationCeremony';

    /**
     * The year in which the holiday was first established
     */
    public const IMPLEMENT_YEAR = 2019;

    /**
     *
     *
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testEmperorsCoronationDay(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2019,
            new DateTime('2019-10-22', new DateTimeZone(self::TIMEZONE))
        );
    }


    /**
     * @throws ReflectionException
     */
    public function testEmperorsBirthdayBefore2019(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::IMPLEMENT_YEAR - 1)
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testEmperorsBirthdayAfter2020(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::IMPLEMENT_YEAR + 1)
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
            2019,
            [self::LOCALE => '即位礼正殿の儀']
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
            2019,
            Holiday::TYPE_OFFICIAL
        );
    }
}
