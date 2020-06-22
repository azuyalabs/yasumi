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

namespace Yasumi\tests\Canada\NewfoundlandAndLabrador;

use ReflectionException;
use Yasumi\Holiday;

/**
 * Class for testing holidays in Newfoundland and Labrador.
 */
class NewfoundlandAndLabradorTest extends NewfoundlandAndLabradorBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in NewfoundlandAndLabrador are defined by the provider class
     * @throws ReflectionException
     */
    public function testOfficialHolidays(): void
    {
        $this->assertDefinedHolidays([
            'goodFriday',
            'christmasDay',
            'stGeorgesDay',
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in NewfoundlandAndLabrador are defined by the provider class
     * @throws ReflectionException
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in NewfoundlandAndLabrador are defined by the provider class
     * @throws ReflectionException
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in NewfoundlandAndLabrador are defined by the provider class
     * @throws ReflectionException
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([
            'stPatricksDay',
            'orangemensDay',
        ], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in NewfoundlandAndLabrador are defined by the provider class
     * @throws ReflectionException
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear(1978);
    }
}
