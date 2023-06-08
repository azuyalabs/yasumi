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

namespace Yasumi\tests\Georgia;

use Yasumi\Holiday;
use Yasumi\Provider\Georgia;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Georgia.
 *
 * @author Zurab Sardarov <zurab.sardarov@gmail.com>
 */
class GeorgiaTest extends GeorgiaBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear();
    }

    /**
     * Tests if all official holidays in Georgia are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'easter',
            'victoryDay',
            'mothersDay',
            'newYearsDay',
            'internationalWomensDay',
            'secondDayOfNewYear',
            'orthodoxChristmasDay',
            'stAndrewsDay',
            'orthodoxEpiphanyDay',
            'mtskhetobaDay',
            'stMarysDay',
            'stGeorgesDay',
        ];

        if ($this->year >= Georgia::PROCLAMATION_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'independenceDay';
        }
        if ($this->year >= Georgia::APRIL_NINE_TRAGEDY_YEAR) {
            $holidays[] = 'unityDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Georgia are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Georgia are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Georgia are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Georgia are defined by the provider class.
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 3);
    }
}
