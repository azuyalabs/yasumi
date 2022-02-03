<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Argentina;

use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\Argentina;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Argentina.
 */
class ArgentinaTest extends ArgentinaBaseTestCase implements ProviderTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected int $year;

    /**
     * Initial setup of this Test Case.
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear(1980);
    }

    /**
     * Tests if all official holidays in Argentina are defined by the provider class.
     *
     * @throws ReflectionException
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'internationalWorkersDay',
            'malvinasDay',
            'mayRevolution',
            'generalMartinMigueldeGuemesDay',
            'flagDay',
            'generalJoseSanMartinDay',
            'raceDay',
            'nationalSovereigntyDay',
            'immaculateConceptionDay',
            'christmasDay',
        ];

        if ($this->year >= Argentina::PROCLAMATION_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'independenceDay';
        }

        if ($this->year >= 2006) {
            $holidays[] = 'remembranceDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Argentina are defined by the provider class.
     *
     * @throws ReflectionException
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([
            'carnavalMonday',
            'carnavalTuesday',
            'goodFriday',
            'easter',
        ], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * @throws ReflectionException
     */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 1);
    }
}
