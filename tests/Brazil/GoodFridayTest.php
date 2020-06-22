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

use DateInterval;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Good Friday in Brazil.
 */
class GoodFridayTest extends BrazilBaseTestCase implements YasumiTestCaseInterface
{
    use ChristianHolidays;

    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'goodFriday';

    /**
     * Tests Good Friday.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testGoodFriday(): void
    {
        $year = 1997;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $this->calculateEaster($year, self::TIMEZONE)->sub(new DateInterval('P2D'))
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
            [self::LOCALE => 'Sexta feira santa']
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
