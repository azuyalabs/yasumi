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

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use Yasumi\Yasumi;

/**
 * Class containing various tests pertaining to the listing of working day
 * dates (i.e. non-holiday and non-weekend days).
 */
class WorkdayTest extends TestCase
{
    private const HOLIDAY_PROVIDER = 'Belgium';

    /**
     * Tests the getWorkdays list.
     *
     * @dataProvider dataProviderGetWorkdays
     *
     * @param string $start
     * @param string $end
     * @param array $expectedList
     */
    public function testGetWorkdays(string $start, string $end, array $expectedList): void
    {
        $startDate = new \DateTime($start);
        $endDate   = new \DateTime($end);
        $yasumiProvider = Yasumi::create(self::HOLIDAY_PROVIDER, (int)$startDate->format('Y'));

        $workdayList = $yasumiProvider->getWorkdays($startDate, $endDate);
        $plainList = \array_map(
            function ($date) {
              return $date->format('Y-m-d');
            },
            $workdayList
        );

        $this->assertSame($expectedList, $plainList);
    }

    /**
     * @return array
     */
    public function dataProviderGetWorkdays(): array
    {
        return [
            [
                '2020-01-01',
                '2020-01-31',
                [
                    '2020-01-02',
                    '2020-01-03',
                    '2020-01-06',
                    '2020-01-07',
                    '2020-01-08',
                    '2020-01-09',
                    '2020-01-10',
                    '2020-01-13',
                    '2020-01-14',
                    '2020-01-15',
                    '2020-01-16',
                    '2020-01-17',
                    '2020-01-20',
                    '2020-01-21',
                    '2020-01-22',
                    '2020-01-23',
                    '2020-01-24',
                    '2020-01-27',
                    '2020-01-28',
                    '2020-01-29',
                    '2020-01-30',
                    '2020-01-31',
                ],
            ],
            [
                '2020-05-01',
                '2020-05-03',
                [],
            ],
        ];
    }
}
