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
 * Class for testing Proclamation of The Republic Day in Brazil.
 */
class ProclamationOfRepublicDayTest extends BrazilBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'proclamationOfRepublicDay';

    /**
     * The year in which the holiday was first established
     */
    public const ESTABLISHMENT_YEAR = 1889;

    /**
     * Tests Proclamação da República on or after 1889.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testProclamacaoDaRepublicaAfter1889(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-11-15", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Proclamação da República on or before 1889.
     * @throws ReflectionException
     */
    public function testProclamacaoDaRepublicaBefore1889(): void
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
            [self::LOCALE => 'Dia da Proclamação da República']
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
