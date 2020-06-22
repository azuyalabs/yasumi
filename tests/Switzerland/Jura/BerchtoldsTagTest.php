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

namespace Yasumi\tests\Switzerland\Jura;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing BerchtoldsTag in Jura (Switzerland).
 */
class BerchtoldsTagTest extends JuraBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'berchtoldsTag';

    /**
     * Tests BerchtoldsTag
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testBerchtoldsTag(): void
    {
        $year = $this->generateRandomYear();
        $date = new DateTime($year . '-01-02', new DateTimeZone(self::TIMEZONE));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }

    /**
     * Tests translated name of BerchtoldsTag.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Jour de la Saint-Berthold']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
