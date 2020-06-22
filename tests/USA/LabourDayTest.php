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
 * Class for testing Labour Day in the USA.
 */
class LabourDayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'labourDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1887;

    /**
     * Tests Labour Day on or after 1887. Labour Day was established since 1887 on the first Monday of September.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testLabourDayOnAfter1887(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("first monday of september $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Labour Day before 1887. Labour Day was established since 1887 on the first Monday of September.
     * @throws ReflectionException
     */
    public function testLabourDayBefore1887(): void
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
            [self::LOCALE => 'Labor Day']
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
