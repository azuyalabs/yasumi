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

namespace Yasumi\tests\Austria\LowerAustria;

use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Lower Austria (Austria).
 */
class LowerAustriaTest extends LowerAustriaBaseTestCase implements ProviderTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Initial setup of this Test Case.
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear(1135);
    }

    /**
     * Tests if all official holidays in Lower Austria (Austria) are defined by the provider class.
     *
     * @throws ReflectionException
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'ascensionDay',
            'assumptionOfMary',
            'corpusChristi',
            'easter',
            'easterMonday',
            'epiphany',
            'allSaintsDay',
            'internationalWorkersDay',
            'newYearsDay',
            'pentecostMonday',
            'christmasDay',
            'secondChristmasDay',
        ];

        if (1955 <= $this->year) {
            $holidays[] = 'nationalDay';
        }

        if (1136 <= $this->year) {
            $holidays[] = 'stLeopoldsDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Lower Austria (Austria) are defined by the provider class.
     *
     * @throws ReflectionException
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays(['pentecost'], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Lower Austria (Austria) are defined by the provider class.
     *
     * @throws ReflectionException
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Lower Austria (Austria) are defined by the provider class.
     *
     * @throws ReflectionException
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Lower Austria (Austria) are defined by the provider class.
     *
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
