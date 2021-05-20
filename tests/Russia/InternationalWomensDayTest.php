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

namespace Yasumi\tests\Russia;

use DateTime;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for International Women's day in Russia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class InternationalWomensDayTest extends RussiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'internationalWomensDay';

    /**
     * @throws Exception
     */
    public function holidayDataProvider(): array
    {
        return $this->generateRandomDates(3, 8, self::TIMEZONE);
    }

    /**
     * @dataProvider holidayDataProvider
     *
     * @throws ReflectionException
     */
    public function testHoliday(int $year, DateTime $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * {@inheritdoc}
     *
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Международный женский день']
        );
    }

    /**
     * {@inheritdoc}
     *
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
