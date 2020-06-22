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

namespace Yasumi\tests\Croatia;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Independece Day in Croatia.
 */
class IndependenceDayTest extends CroatiaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'independenceDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1991;

    /**
     * The year after which this is no longer a holiday
     */
    public const DISBANDMENT_YEAR = 2020;

    /**
     * Tests Independence Day on or after 1991.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIndependenceDayOnAfter1991(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::DISBANDMENT_YEAR - 1);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-10-8", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Independence Day before 1991.
     * @throws ReflectionException
     */
    public function testIndependenceDayBefore1991(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests Independence Day before 1991.
     * @throws ReflectionException
     */
    public function testIndependenceDayAfterDisbandment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::DISBANDMENT_YEAR)
        );
    }

    /**
     * Tests translated name of Independence Day.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::DISBANDMENT_YEAR - 1),
            [self::LOCALE => 'Dan neovisnosti']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::DISBANDMENT_YEAR - 1),
            Holiday::TYPE_OFFICIAL
        );
    }
}
