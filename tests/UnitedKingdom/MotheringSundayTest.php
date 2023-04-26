<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\UnitedKingdom;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;
use Yasumi\tests\UnitedKingdom\England\EnglandBaseTestCase;

class MotheringSundayTest extends EnglandBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'motheringSunday';

    /**
     * @dataProvider HolidayDataProvider
     *
     * @throws \Exception
     */
    public function testHoliday(int $year, string $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @return array<array> list of test dates for the holiday defined in this test
     *
     * @throws \Exception
     */
    public function HolidayDataProvider(): array
    {
        $data = [];

        for ($y = 0; $y < 50; ++$y) {
            $year = $this->generateRandomYear();
            $date = $this->calculateEaster($year, self::TIMEZONE);
            $date->sub(new \DateInterval('P3W'));

            $data[] = [$year, $date->format('Y-m-d')];
        }

        // some extra random dates
        $data[] = [2016, '2016-03-06'];
        $data[] = [2022, '2022-03-27'];

        return $data;
    }

    /**
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Mothering Sunday']
        );
    }

    /**
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            Holiday::TYPE_OTHER
        );
    }
}
