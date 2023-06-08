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

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use Yasumi\Exception\InvalidYearException;
use Yasumi\Exception\ProviderNotFoundException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

class YasumiTest extends TestCase
{
    use YasumiBase;

    public const YEAR_LOWER_BOUND = 1000;

    public const YEAR_UPPER_BOUND = 9999;

    public function testCreateWithInvalidYear(): void
    {
        $this->expectException(InvalidYearException::class);

        Yasumi::create('Japan', 10100);
    }

    public function testCreateWithInvalidProvider(): void
    {
        $this->expectException(ProviderNotFoundException::class);

        Yasumi::create('Mars');
    }

    public function testCreateWithInvalidProviderBecauseItsATrait(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Yasumi::create('CommonHolidays');
    }

    public function testCreateWithAbstractClassProvider(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Yasumi::create('AbstractProvider');
    }

    public function testCreateWithAbstractExtension(): void
    {
        $class = YasumiExternalProvider::class;
        $instance = Yasumi::create(
            $class,
            self::numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND)
        );
        self::assertInstanceOf(YasumiExternalProvider::class, $instance);
    }

    public function testCreateWithInvalidLocale(): void
    {
        $this->expectException(UnknownLocaleException::class);

        Yasumi::create(
            'Japan',
            self::numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND),
            'wx_YZ'
        );
    }

    public function testCount(): void
    {
        // There are 16 holidays in Japan in the year 2015, with 1 substituted holiday.
        $holidays = Yasumi::create('Japan', 2015);

        self::assertIsInt($holidays->count());
        self::assertEquals(16, $holidays->count());
        self::assertNotEquals(17, $holidays->count());
    }

    public function testGetType(): void
    {
        $holidays = Yasumi::create('Japan', self::numberBetween(1949, self::YEAR_UPPER_BOUND));
        $holiday = $holidays->getHoliday('newYearsDay');

        self::assertIsString($holiday->getType());
    }

    public function testGetYear(): void
    {
        $year = self::numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND);
        $holidays = Yasumi::create('Netherlands', $year);

        self::assertIsInt($holidays->getYear());
        self::assertEquals($year, $holidays->getYear());
    }

    /**
     * Tests that the next function returns the next upcoming date (i.e. next year) for the given holiday.
     *
     * @throws \Exception
     */
    public function testNext(): void
    {
        $country = 'Japan';
        $name = 'childrensDay';
        $year = self::numberBetween(1949, self::YEAR_UPPER_BOUND - 1);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday($country, $name, $year + 1, $holidays->next($name));
    }

    public function testNextWithBlankKey(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $holidays = Yasumi::create(
            'Netherlands',
            self::numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND - 1)
        );
        $holidays->next('');
    }

    /**
     * Tests the previous function returns the previous date (i.e. previous year) for the given holiday.
     *
     * @throws \Exception
     */
    public function testPrevious(): void
    {
        $country = 'Netherlands';
        $name = 'liberationDay';
        $year_lower_limit = 1949;
        $year = self::numberBetween($year_lower_limit, self::YEAR_UPPER_BOUND);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday(
            $country,
            $name,
            ($year > $year_lower_limit) ? $year - 1 : $year_lower_limit,
            $holidays->previous($name)
        );
    }

    public function testPreviousWithBlankKey(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $holidays = Yasumi::create(
            'Netherlands',
            self::numberBetween(self::YEAR_LOWER_BOUND + 1, self::YEAR_UPPER_BOUND)
        );
        $holidays->previous('');
    }

    public function testGetHolidayNames(): void
    {
        $holidays = Yasumi::create('Japan', 2015);
        $holidayNames = $holidays->getHolidayNames();

        self::assertIsArray($holidayNames);
        self::assertCount(17, $holidayNames);
        self::assertContains('newYearsDay', $holidayNames);
    }

    public function testWhenIs(): void
    {
        $holidays = Yasumi::create('Japan', 2010);

        $when = $holidays->whenIs('autumnalEquinoxDay');

        self::assertIsString($when);
        self::assertEquals('2010-09-23', $when);
    }

    public function testWhenIsWithBlankKey(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $holidays = Yasumi::create('Japan', 2010);
        $holidays->whenIs('');
    }

    public function testGetHolidayWithBlankKey(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $holidays = Yasumi::create('Netherlands', 1999);
        $holidays->getHoliday('');
    }

    public function testWhatWeekDayIs(): void
    {
        $holidays = Yasumi::create('Netherlands', 2110);
        $weekDay = $holidays->whatWeekDayIs('stMartinsDay');

        self::assertIsInt($weekDay);
        self::assertEquals(2, $weekDay);
    }

    public function testWhatWeekDayIsWithBlankKey(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $holidays = Yasumi::create('Netherlands', 2388);
        $holidays->whatWeekDayIs('');
    }

    /**
     * Tests that the getProviders function returns an array containing all available holiday providers.
     *
     * @throws \ReflectionException
     */
    public function testGetProviders(): void
    {
        $providers = Yasumi::getProviders();

        self::assertNotEmpty($providers);
        self::assertIsArray($providers);
        self::assertContains('Netherlands', $providers);
        self::assertEquals('USA', $providers['US']);
        self::assertNotContains('AbstractProvider', $providers);
    }

    /**
     * Tests that the getProviders function (static call) returns the same data when called again.
     *
     * @throws \ReflectionException
     */
    public function testGetProvidersStaticCall(): void
    {
        $provider = 'Ireland';
        $providers = Yasumi::getProviders();
        $initial_providers = $providers;

        self::assertNotEmpty($providers);
        self::assertIsArray($providers);
        self::assertContains($provider, $providers);

        $providers = Yasumi::getProviders();
        self::assertNotEmpty($providers);
        self::assertIsArray($providers);
        self::assertContains($provider, $providers);
        self::assertEquals($initial_providers, $providers);
    }

    /**
     * Tests that the isHoliday function returns a boolean true for a date that is defined as a holiday.
     *
     * Note that this function does *NOT* determine whether a date is a working or non-working day. It
     * only asserts that it is a date calculated by the Holiday Provider.
     *
     * @throws \Exception
     */
    public function testIsHoliday(): void
    {
        $year = 2110;
        $provider = 'Spain';
        $date = $year.'-08-15';

        // Assertion using a DateTime instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new \DateTime($date));
        self::assertIsBool($isHoliday);
        self::assertTrue($isHoliday);

        // Assertion using a DateTimeImmutable instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new \DateTimeImmutable($date));
        self::assertIsBool($isHoliday);
        self::assertTrue($isHoliday);

        unset($isHoliday);
    }

    /**
     * Tests that the isHoliday function returns a boolean false for a date that is not defined as a holiday.
     *
     * Note that this function does *NOT* determine whether a date is a working or non-working day. It
     * only asserts that it is a date calculated by the Holiday Provider.
     *
     * @throws \Exception
     */
    public function testIsNotHoliday(): void
    {
        $year = 5220;
        $provider = 'Japan';
        $date = $year.'-06-10';

        // Assertion using a DateTime instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new \DateTime($date));
        self::assertIsBool($isHoliday);
        self::assertFalse($isHoliday);

        // Assertion using a DateTimeImmutable instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new \DateTimeImmutable($date));
        self::assertIsBool($isHoliday);
        self::assertFalse($isHoliday);

        unset($isHoliday);
    }

    /**
     * Tests that the isWorkingDay function returns a boolean true for a date that is defined as a holiday or falls in
     * the weekend.
     *
     * @TODO Add additional unit tests for those holiday providers that differ from the global definition
     *
     * @throws \Exception
     */
    public function testIsWorkingDay(): void
    {
        $year = 2020;
        $provider = 'Netherlands';
        $date = $year.'-06-02';

        // Assertion using a DateTime instance
        $isWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new \DateTime($date));
        self::assertIsBool($isWorkingDay);
        self::assertTrue($isWorkingDay);

        // Assertion using a DateTimeImmutable instance
        $isWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new \DateTimeImmutable($date));
        self::assertIsBool($isWorkingDay);
        self::assertTrue($isWorkingDay);

        unset($isWorkingDay);
    }

    /**
     * Tests that the isWorkingDay function returns a boolean true for a date that is defined as a holiday or falls in
     * the weekend.
     *
     * @TODO Add additional unit tests for those holiday providers that differ from the global definition
     *
     * @throws \Exception
     */
    public function testIsNotWorkingDay(): void
    {
        $year = 2016;
        $provider = 'Japan';
        $date = $year.'-01-11';

        // Assertion using a DateTime instance
        $isNotWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new \DateTime($date));
        self::assertIsBool($isNotWorkingDay);
        self::assertFalse($isNotWorkingDay);

        // Assertion using a DateTimeImmutable instance
        $isNotWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new \DateTimeImmutable($date));
        self::assertIsBool($isNotWorkingDay);
        self::assertFalse($isNotWorkingDay);

        unset($isNotWorkingDay);
    }

    public function testRemoveHoliday(): void
    {
        $provider = Yasumi::create('Ireland', 2018);
        $holidays = $provider->getHolidays();

        // Assert initial list of holidays
        self::assertCount(13, $holidays);
        self::assertArrayHasKey('newYearsDay', $holidays);
        self::assertArrayHasKey('stPatricksDay', $holidays);
        self::assertArrayHasKey('substituteHoliday:stPatricksDay', $holidays);
        self::assertArrayHasKey('goodFriday', $holidays);
        self::assertArrayHasKey('easter', $holidays);
        self::assertArrayHasKey('easterMonday', $holidays);
        self::assertArrayHasKey('mayDay', $holidays);
        self::assertArrayHasKey('pentecost', $holidays);
        self::assertArrayHasKey('juneHoliday', $holidays);
        self::assertArrayHasKey('augustHoliday', $holidays);
        self::assertArrayHasKey('octoberHoliday', $holidays);
        self::assertArrayHasKey('christmasDay', $holidays);
        self::assertArrayHasKey('stStephensDay', $holidays);

        $provider->removeHoliday('juneHoliday');
        $provider->removeHoliday('augustHoliday');
        $provider->removeHoliday('octoberHoliday');

        $holidaysAfterRemoval = $provider->getHolidays();

        // Assert list of holidays after removal of some holidays
        self::assertCount(10, $holidaysAfterRemoval);
        self::assertArrayHasKey('newYearsDay', $holidaysAfterRemoval);
        self::assertArrayHasKey('stPatricksDay', $holidaysAfterRemoval);
        self::assertArrayHasKey('substituteHoliday:stPatricksDay', $holidaysAfterRemoval);
        self::assertArrayHasKey('goodFriday', $holidaysAfterRemoval);
        self::assertArrayHasKey('easter', $holidaysAfterRemoval);
        self::assertArrayHasKey('easterMonday', $holidaysAfterRemoval);
        self::assertArrayHasKey('mayDay', $holidaysAfterRemoval);
        self::assertArrayHasKey('pentecost', $holidaysAfterRemoval);
        self::assertArrayHasKey('christmasDay', $holidaysAfterRemoval);
        self::assertArrayHasKey('stStephensDay', $holidaysAfterRemoval);
        self::assertArrayNotHasKey('juneHoliday', $holidaysAfterRemoval);
        self::assertArrayNotHasKey('augustHoliday', $holidaysAfterRemoval);
        self::assertArrayNotHasKey('octoberHoliday', $holidaysAfterRemoval);
    }

    /**
     * Tests that a holiday provider instance can be created by using the ISO3166-2
     * country/region code. (Using the Yasumi::createByISO3166_2 method).
     *
     * @throws \ReflectionException
     */
    public function testCreateByISO31662(): void
    {
        $year = self::numberBetween(
            self::YEAR_LOWER_BOUND,
            self::YEAR_UPPER_BOUND
        );

        $provider = Yasumi::createByISO3166_2(
            'JP',
            $year
        );

        self::assertEquals($year, $provider->getYear());
    }

    /**
     * Tests that a ProviderNotFoundException is thrown when providing a invalid
     * ISO3166-2 code when using the Yasumi::createByISO3166_2 method.
     *
     * @throws \ReflectionException
     */
    public function testCreateByISO31662WithInvalidCode(): void
    {
        $this->expectException(ProviderNotFoundException::class);

        Yasumi::createByISO3166_2('XX', 2019);
    }

    /**
     * Tests that a holiday can be added to a provider. In addition, it
     * tests that the same holiday instance isn't added twice.
     *
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testAddExistingHoliday(): void
    {
        $provider = Yasumi::createByISO3166_2('NL', 2019);
        $holidayName = 'testHoliday';

        $holiday = new Holiday($holidayName, [], new \DateTime());
        $originalHolidays = $provider->getHolidayNames();

        // Add a new holiday
        $provider->addHoliday($holiday);
        $newHolidays = $provider->getHolidayNames();
        self::assertContains($holidayName, $provider->getHolidayNames());
        self::assertNotSameSize($originalHolidays, $newHolidays);
        self::assertNotEquals($newHolidays, $originalHolidays);

        // Add same holiday again
        $provider->addHoliday($holiday);
        self::assertContains($holidayName, $provider->getHolidayNames());
        self::assertSameSize($newHolidays, $provider->getHolidayNames());
        self::assertNotSameSize($originalHolidays, $provider->getHolidayNames());
        self::assertEquals($newHolidays, $provider->getHolidayNames());
        self::assertNotEquals($originalHolidays, $provider->getHolidayNames());
    }
}
