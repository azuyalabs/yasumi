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

namespace Yasumi\tests\Turkey;

use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

class TurkeyTest extends TurkeyBaseTestCase implements ProviderTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear();
    }

    /**
     * @throws ReflectionException
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'labourDay',
        ];

        /*
         * Not sure if 1920 is the first year of celebration as above source mentions Law No. 3466 that "May 19" was
         * made official June 20, 1938.
         * @see: https://en.wikipedia.org/wiki/Commemoration_of_Atat%C3%BCrk,_Youth_and_Sports_Day
         */
        if (1920 <= $this->year) {
            $holidays[] = 'commemorationAtaturk';
        }

        if (1922 <= $this->year) {
            $holidays[] = 'nationalSovereigntyDay';
        }

        if (2017 <= $this->year) {
            $holidays[] = 'democracyDay';
        }

        if (1926 <= $this->year) {
            $holidays[] = 'victoryDay';
        }

        if (1923 < $this->year) {
            $holidays[] = 'republicDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * @throws ReflectionException
     */
    public function testObservedHolidays(): void
    {
        $holidays = [];

        if (1923 <= $this->year && 1926 > $this->year) {
            $holidays[] = 'victoryDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * @throws ReflectionException
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * @throws ReflectionException
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * @throws ReflectionException
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * @throws ReflectionException
     */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 2);
    }
}
