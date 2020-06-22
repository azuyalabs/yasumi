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

namespace Yasumi\tests\Brazil;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Independence Day in Brazil.
 */
class IndependenceDayTest extends BrazilBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'independenceDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1822;

    /**
     * Tests Dia da independência do Brasil on or after 1822.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testDiaDaIndependenciaDoBrasilAfter1822(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-09-07", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Dia da independência do Brasil on or before 1822.
     * @throws ReflectionException
     */
    public function testDiaDaIndependenciaDoBrasilBefore1822(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => 'Dia da Independência do Brasil']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
