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

namespace Yasumi\tests\Australia\Tasmania\Northwest\CircularHead;

use Yasumi\Holiday;

/**
 * Class for testing holidays in Circular Head (Australia).
 */
class CircularHeadTest extends CircularHeadBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected int $year;

    /**
     * Initial setup of this Test Case.
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear(1921);
    }

    /**
     * Tests if all official holidays in Circular Head (Australia) are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $expectedHolidays = [
            'newYearsDay',
            'goodFriday',
            'easterMonday',
            'christmasDay',
            'secondChristmasDay',
            'australiaDay',
            'anzacDay',
            'queensBirthday',
            'eightHourDay',
            'recreationDay',
            'burnieShow',
            'agfest',
        ];
        if (2022 == $this->year) {
            $expectedHolidays[] = 'nationalDayOfMourning';
        }
        $this->assertDefinedHolidays($expectedHolidays, $this->region, $this->year, Holiday::TYPE_OFFICIAL);
    }
}
