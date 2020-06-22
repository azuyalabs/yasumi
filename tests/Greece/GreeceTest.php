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

namespace Yasumi\tests\Greece;

use ReflectionException;
use Yasumi\Holiday;

/**
 * Class for testing holidays in Greece.
 */
class GreeceTest extends GreeceBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Greece are defined by the provider class
     * @throws ReflectionException
     */
    public function testOfficialHolidays(): void
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'internationalWorkersDay',
            'epiphany',
            'annunciation',
            'goodFriday',
            'easter',
            'easterMonday',
            'ascensionDay',
            'pentecost',
            'pentecostMonday',
            'assumptionOfMary',
            'christmasDay',
            'cleanMonday',
            'independenceDay',
            'ohiDay',
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Greece are defined by the provider class
     * @throws ReflectionException
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Greece are defined by the provider class
     * @throws ReflectionException
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Greece are defined by the provider class
     * @throws ReflectionException
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Greece are defined by the provider class
     * @throws ReflectionException
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays(
            ['threeHolyHierarchs', 'polytechnio'],
            self::REGION,
            $this->year,
            Holiday::TYPE_OTHER
        );
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear(1985);
    }
}
