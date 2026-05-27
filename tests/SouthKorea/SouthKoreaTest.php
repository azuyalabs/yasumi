<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\SouthKorea;

use PHPUnit\Framework\Attributes\DataProvider;
use Yasumi\Holiday;
use Yasumi\Provider\SouthKorea;
use Yasumi\ProviderInterface;
use Yasumi\SubstituteHoliday;
use Yasumi\tests\ProviderTestCase;
use Yasumi\Yasumi;

/**
 * Class for testing holidays in South Korea.
 */
class SouthKoreaTest extends SouthKoreaBaseTestCase implements ProviderTestCase
{
    /** @var int The year in which the holiday was first established */
    public const ESTABLISHMENT_YEAR = 1949;

    /**
     * Test if the provider returns a valid holiday list
     */
    public function testCount(): void
    {
        // Assert years from 1949 onwards.
        $year = self::generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertNotCount(0, Yasumi::create(self::REGION, $year), "Missing holiday data for year {$year}.");

        // Assert years before 1949.
        $year = self::generateRandomYear(null, self::ESTABLISHMENT_YEAR);
        $this->assertCount(0, Yasumi::create(self::REGION, $year), 'Data available from 1949 onwards only.');
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 3);
    }

    /**
     * Testing the provider object
     */
    public function testProvider(): void
    {
        // Assert with SouthKorea provider instance
        $this->assertInstanceOf(ProviderInterface::class, Yasumi::create(self::REGION, self::generateRandomYear()));
    }

    /**
     * Testing the holiday object
     */
    #[DataProvider('HolidaysDataProvider')]
    public function testHolidays(Holiday $holiday, string $key): void
    {
        // Asserting the type of holidays
        $this->assertInstanceOf(Holiday::class, $holiday);
        $this->assertInstanceOf(\DateTimeInterface::class, $holiday);

        // Asserting the type of alternative holidays
        if (str_starts_with($key, 'substituteHoliday:')) {
            $this->assertInstanceOf(SubstituteHoliday::class, $holiday);
        }
    }

    /**
     * Testing the holiday name translations
     *
     * Test only whether the translation exists
     */
    #[DataProvider('HolidaysDataProvider')]
    public function testTranslations(Holiday $holiday, string $key): void
    {
        $this->assertNotSame('', $holiday->getName(['en']), "Missing en translation for {$key}");
        $this->assertNotSame('', $holiday->getName(['ko']), "Missing ko translation for {$key}");
    }

    /**
     * Test if the method exists
     */
    public function testMethods(): void
    {
        // Assert the existence of the holiday method within the class
        foreach (array_keys(SouthKorea::HOLIDAY_NAMES) as $key) {
            $this->assertIsString($key);
            $this->assertTrue(method_exists(SouthKorea::class, $key), "Method {$key} does not exist.");
        }
    }

    /**
     * Data provider for holiday data
     *
     * @return \Generator<Holiday, string>
     */
    public static function HolidaysDataProvider(): \Generator
    {
        $provider = Yasumi::create(self::REGION, static::generateRandomYear(self::ESTABLISHMENT_YEAR));

        foreach ($provider->getHolidays() as $holiday) {
            yield [$holiday, $holiday->getKey()];
        }
    }
}
