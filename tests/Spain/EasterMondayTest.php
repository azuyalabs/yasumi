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

namespace Yasumi\tests\Spain;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Easter Monday in Spain.
 */
class EasterMondayTest extends SpainBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'easterMonday';

    /**
     * Name of the region (e.g. country / state) to be tested
     * Using Catalonia as the holiday provider as not all regions celebrate Easter Monday in Spain.
     */
    public const REGION = 'Spain/Catalonia';

    /**
     * Tests the holiday defined in this test.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHoliday(): void
    {
        $year = 2216;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-4-8", new DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(),
            [self::LOCALE => 'Lunes de Pascua']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }
}
