<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Argentina;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Proclamation of The Republic Day in Argentina.
 */
class FlagDayTest extends ArgentinaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'flagDay';

    /**
     * Tests the holiday defined in this test.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHoliday(): void
    {
        $year = 1938;
        $this->assertHoliday(
          self::REGION,
          self::HOLIDAY,
          $year,
          new DateTime("$year-06-20", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of the holiday.
     *
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
          self::REGION,
          self::HOLIDAY,
          $this->generateRandomYear(),
          [self::LOCALE => 'Paso a la Inmortalidad del General Manuel Belgrano']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
