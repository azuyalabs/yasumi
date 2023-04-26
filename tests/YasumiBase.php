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

namespace Yasumi\tests;

use PHPUnit\Framework\AssertionFailedError;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Filters\BankHolidaysFilter;
use Yasumi\Filters\ObservedHolidaysFilter;
use Yasumi\Filters\OfficialHolidaysFilter;
use Yasumi\Filters\OtherHolidaysFilter;
use Yasumi\Filters\SeasonalHolidaysFilter;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;
use Yasumi\Yasumi;

/**
 * Trait containing useful functions for the various unit tests.
 */
trait YasumiBase
{
    use Randomizer;

    /**
     * Asserts the expected holidays are a holidays for the given provider and year.
     *
     * @param array<string> $expectedHolidays list of all known holidays of the given provider
     * @param string        $provider         holiday provider (i.e. country/state) for which the holidays need to be
     *                                        tested.
     * @param int           $year             holiday calendar year
     * @param string        $type             type of holiday. Use the following constants: TYPE_OFFICIAL,
     *                                        TYPE_OBSERVANCE, TYPE_SEASON, TYPE_BANK or TYPE_OTHER.
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws UnknownLocaleException
     */
    public function assertDefinedHolidays(
        array $expectedHolidays,
        string $provider,
        int $year,
        string $type
    ): void {
        $holidays = Yasumi::create($provider, $year);

        switch ($type) {
            case Holiday::TYPE_OFFICIAL:
                $holidays = new OfficialHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_OBSERVANCE:
                $holidays = new ObservedHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_SEASON:
                $holidays = new SeasonalHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_BANK:
                $holidays = new BankHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_OTHER:
                $holidays = new OtherHolidaysFilter($holidays->getIterator());
                break;
        }

        // Loop through all known holidays and assert they are defined by the provider class.
        foreach ($expectedHolidays as $holiday) {
            self::assertArrayHasKey($holiday, iterator_to_array($holidays));
        }
    }

    /**
     * Asserts expected date is a holiday for the given year and name.
     *
     * @param string    $provider holiday provider (i.e. country/state) for which the holiday need to be tested.
     * @param string    $key      key of the holiday to be checked against
     * @param int       $year     holiday calendar year
     * @param \DateTime $expected date to be checked against
     *
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws AssertionFailedError
     */
    public function assertHoliday(
        string $provider,
        string $key,
        int $year,
        \DateTimeInterface $expected
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        self::assertInstanceOf(Holiday::class, $holiday);
        self::assertEquals($expected, $holiday);
        self::assertTrue($holidays->isHoliday($holiday));
    }

    /**
     * Asserts the expected date is a substitute holiday for that given year and name.
     *
     * @param string    $provider the holiday provider (i.e. country/state) for which the holiday need to be tested.
     * @param string    $key      key of the substituted holiday to be checked against
     * @param int       $year     holiday calendar year
     * @param \DateTime $expected date to be checked against
     *
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws AssertionFailedError
     */
    public function assertSubstituteHoliday(
        string $provider,
        string $key,
        int $year,
        \DateTimeInterface $expected
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday('substituteHoliday:'.$key);

        self::assertInstanceOf(SubstituteHoliday::class, $holiday);
        self::assertEquals($expected, $holiday);
        self::assertTrue($holidays->isHoliday($holiday));
    }

    /**
     * Asserts the given substitute holiday for a given year does not exist.
     *
     * @param string $provider holiday provider (i.e. country/state) for which the holiday need to be tested.
     * @param string $key      key of the substituted holiday to be checked against
     * @param int    $year     holiday calendar year
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws UnknownLocaleException
     * @throws AssertionFailedError
     */
    public function assertNotSubstituteHoliday(
        string $provider,
        string $key,
        int $year
    ): void {
        $this->assertNotHoliday(
            $provider,
            'substituteHoliday:'.$key,
            $year
        );
    }

    /**
     * Asserts the given holiday for a given year does not exist.
     *
     * @param string $provider holiday provider (i.e. country/state) for which the holiday need to be tested.
     * @param string $key      key of the holiday to be checked against
     * @param int    $year     holiday calendar year
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws UnknownLocaleException
     * @throws AssertionFailedError
     */
    public function assertNotHoliday(
        string $provider,
        string $key,
        int $year
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        self::assertNull($holiday);
    }

    /**
     * Asserts the expected name is provided as a translated holiday name for that given year and name.
     *
     * @param string                $provider     holiday provider (i.e. country/state) for which the holiday need to be tested.
     * @param string                $key          key of the holiday to be checked against
     * @param int                   $year         holiday calendar year
     * @param array<string, string> $translations translations to be checked against
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws UnknownLocaleException
     * @throws AssertionFailedError
     */
    public function assertTranslatedHolidayName(
        string $provider,
        string $key,
        int $year,
        array $translations
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        self::assertInstanceOf(Holiday::class, $holiday, sprintf('No instance for the year `%u`', $year));
        self::assertTrue($holidays->isHoliday($holiday), sprintf('Holiday `%s` not defined for the year `%u`', $key, $year));

        foreach ($translations as $locale => $name) {
            $locales = [$locale];
            $parts = explode('_', $locale);
            while (array_pop($parts) && $parts) {
                $locales[] = implode('_', $parts);
            }

            $translation = null;
            foreach ($locales as $l) {
                if (isset($holiday->translations[$l])) {
                    $translation = $holiday->translations[$l];
                    break;
                }
            }

            self::assertTrue(isset($translation));
            self::assertEquals($name, $translation);
        }
    }

    /**
     * Asserts the expected type is the associated type for the given holiday.
     *
     * @param string $provider holiday provider (i.e. country/region) for which the holiday need to be tested.
     * @param string $key      the key of the holiday to be checked against
     * @param int    $year     holiday calendar year
     * @param string $type     type to be checked against
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws AssertionFailedError
     * @throws UnknownLocaleException
     */
    public function assertHolidayType(
        string $provider,
        string $key,
        int $year,
        string $type
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        self::assertInstanceOf(Holiday::class, $holiday, sprintf('No instance for the year `%u`', $year));
        self::assertEquals($type, $holiday->getType(), sprintf('Expected type `%s`, got `%s` for the year `%u`', $type, $holiday->getType(), $year));
    }

    /**
     * Asserts the expected week day is the week day for the given holiday and year.
     *
     * @param string $provider          holiday provider (i.e. country/state) for which the holiday need to be tested.
     * @param string $key               key of the holiday to be checked against
     * @param int    $year              holiday calendar year
     * @param string $expectedDayOfWeek expected week day (i.e. "Saturday", "Sunday", etc.).
     *
     * @throws AssertionFailedError
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws UnknownLocaleException
     */
    public function assertDayOfWeek(
        string $provider,
        string $key,
        int $year,
        string $expectedDayOfWeek
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        self::assertInstanceOf(Holiday::class, $holiday);
        self::assertTrue($holidays->isHoliday($holiday));
        self::assertEquals($expectedDayOfWeek, $holiday->format('l'));
    }

    /**
     * Asserts the holiday provider has the expected sources number.
     *
     * @param string $provider            holiday provider (i.e. country/state) for which the holiday need to be tested.
     * @param int    $expectedSourceCount expected sources number
     *
     * @throws \Exception
     */
    public function assertSources(string $provider, int $expectedSourceCount): void
    {
        $holidayProvider = Yasumi::create($provider, $this->generateRandomYear());

        self::assertCount($expectedSourceCount, $holidayProvider->getSources());
    }
}
