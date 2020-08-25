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

namespace Yasumi\tests\Base;

use DateTime;
use DateTimeImmutable;
use Exception;
use Faker\Factory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use stdClass;
use TypeError;
use Yasumi\Exception\InvalidYearException;
use Yasumi\Exception\ProviderNotFoundException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class YasumiTest.
 *
 * Contains tests for testing the Holiday class
 */
class YasumiTest extends TestCase
{
    use YasumiBase;

    /**
     * The lower year limit supported by Yasumi
     */
    public const YEAR_LOWER_BOUND = 1000;

    /**
     * The upper year limit supported by Yasumi
     */
    public const YEAR_UPPER_BOUND = 9999;

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid year is given.
     *
     * @throws ReflectionException
     */
    public function testCreateWithInvalidYear(): void
    {
        $this->expectException(InvalidYearException::class);

        Yasumi::create('Japan', 10100);
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid holiday provider is given.
     *
     * @throws ReflectionException
     */
    public function testCreateWithInvalidProvider(): void
    {
        $this->expectException(ProviderNotFoundException::class);

        Yasumi::create('Mars');
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case we try to load a Trait as provider.
     *
     * @throws ReflectionException
     */
    public function testCreateWithInvalidProviderBecauseItsATrait(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Yasumi::create('CommonHolidays');
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case we try to load the AbstractProvider as provider.
     *
     * @throws ReflectionException
     */
    public function testCreateWithAbstractClassProvider(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Yasumi::create('AbstractProvider');
    }

    /**
     * Tests that Yasumi allows external classes that extend the ProviderInterface.
     * @throws ReflectionException
     */
    public function testCreateWithAbstractExtension(): void
    {
        $class = YasumiExternalProvider::class;
        $instance = Yasumi::create(
            $class,
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND)
        );
        $this->assertInstanceOf(YasumiExternalProvider::class, $instance);
    }

    /**
     * Tests that an Yasumi\Exception\UnknownLocaleException is thrown in case an invalid locale is given.
     *
     * @throws ReflectionException
     */
    public function testCreateWithInvalidLocale(): void
    {
        $this->expectException(UnknownLocaleException::class);

        Yasumi::create(
            'Japan',
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND),
            'wx_YZ'
        );
    }

    /**
     * Tests that the count function returns an integer and a correct count for the test holiday provider
     * @throws ReflectionException
     */
    public function testCount(): void
    {
        // There are 16 holidays in Japan in the year 2015, with 1 substituted holiday.
        $holidays = Yasumi::create('Japan', 2015);

        $this->assertIsInt($holidays->count());
        $this->assertEquals(16, $holidays->count());
        $this->assertNotEquals(17, $holidays->count());
    }

    /**
     * Tests that the getType function returns a string for the test holiday provider
     * @throws ReflectionException
     */
    public function testGetType(): void
    {
        $holidays = Yasumi::create('Japan', Factory::create()->numberBetween(1949, self::YEAR_UPPER_BOUND));
        $holiday = $holidays->getHoliday('newYearsDay');

        $this->assertIsString($holiday->getType());
    }

    /**
     * Tests that the getYear function returns an integer for the test holiday provider
     * @throws ReflectionException
     */
    public function testGetYear(): void
    {
        $year = Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND);
        $holidays = Yasumi::create('Netherlands', $year);

        $this->assertIsInt($holidays->getYear());
        $this->assertEquals($year, $holidays->getYear());
    }

    /**
     * Tests that the next function returns the next upcoming date (i.e. next year) for the given holiday
     *
     * @throws ReflectionException
     */
    public function testNext(): void
    {
        $country = 'Japan';
        $name = 'childrensDay';
        $year = Factory::create()->numberBetween(1949, self::YEAR_UPPER_BOUND - 1);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday($country, $name, $year + 1, $holidays->next($name));
    }

    /**
     * Tests the next function that an InvalidArgumentException is thrown in case a blank name is given.
     *
     * @throws ReflectionException
     */
    public function testNextWithBlankKey(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $holidays = Yasumi::create(
            'Netherlands',
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND - 1)
        );
        $holidays->next('');
    }

    /**
     * Tests the previous function returns the previous date (i.e. previous year) for the given holiday
     *
     * @throws ReflectionException
     */
    public function testPrevious(): void
    {
        $country = 'Netherlands';
        $name = 'liberationDay';
        $year_lower_limit = 1949;
        $year = Factory::create()->numberBetween($year_lower_limit, self::YEAR_UPPER_BOUND);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday(
            $country,
            $name,
            (($year > $year_lower_limit) ? $year - 1 : $year_lower_limit),
            $holidays->previous($name)
        );
    }

    /**
     * Tests the previous function that an InvalidArgumentException is thrown in case a blank name is given.
     *
     * @throws ReflectionException
     */
    public function testPreviousWithBlankKey(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $holidays = Yasumi::create(
            'Netherlands',
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND + 1, self::YEAR_UPPER_BOUND)
        );
        $holidays->previous('');
    }

    /**
     * Tests that the getHolidayNames function returns an array and a correct count for the test holiday provider
     * @throws ReflectionException
     */
    public function testGetHolidayNames(): void
    {
        $holidays = Yasumi::create('Japan', 2015);
        $holidayNames = $holidays->getHolidayNames();

        $this->assertIsArray($holidayNames);
        $this->assertCount(17, $holidayNames);
        $this->assertContains('newYearsDay', $holidayNames);
    }

    /**
     * Tests that the WhenIs function returns a string representation of the date the given holiday occurs.
     * @throws ReflectionException
     */
    public function testWhenIs(): void
    {
        $holidays = Yasumi::create('Japan', 2010);

        $when = $holidays->whenIs('autumnalEquinoxDay');

        $this->assertIsString($when);
        $this->assertEquals('2010-09-23', $when);
    }

    /**
     * Tests that the WhenIs function throws an InvalidArgumentException when a blank key is given.
     *
     * @throws ReflectionException
     */
    public function testWhenIsWithBlankKey(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $holidays = Yasumi::create('Japan', 2010);
        $holidays->whenIs('');
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case a blank name is given for the getHoliday function.
     *
     * @throws ReflectionException
     */
    public function testGetHolidayWithBlankKey(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $holidays = Yasumi::create('Netherlands', 1999);
        $holidays->getHoliday('');
    }

    /**
     * Tests that the whatWeekDayIs function returns an integer representation of the day of the week the given holiday
     * is occurring.
     * @throws ReflectionException
     */
    public function testWhatWeekDayIs(): void
    {
        $holidays = Yasumi::create('Netherlands', 2110);
        $weekDay = $holidays->whatWeekDayIs('stMartinsDay');

        $this->assertIsInt($weekDay);
        $this->assertEquals(2, $weekDay);
    }

    /**
     * Tests that the whatWeekDayIs function throws an InvalidArgumentException when a blank name is given.
     *
     * @throws ReflectionException
     */
    public function testWhatWeekDayIsWithBlankKey(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $holidays = Yasumi::create('Netherlands', 2388);
        $holidays->whatWeekDayIs('');
    }

    /**
     * Tests that the getProviders function returns an array containing all available holiday providers.
     * @throws ReflectionException
     */
    public function testGetProviders(): void
    {
        $providers = Yasumi::getProviders();

        $this->assertNotEmpty($providers);
        $this->assertIsArray($providers);
        $this->assertContains('Netherlands', $providers);
        $this->assertEquals('USA', $providers['US']);
        $this->assertNotContains('AbstractProvider', $providers);
    }

    /**
     * Tests that the getProviders function (static call) returns the same data when called again.
     *
     * @throws ReflectionException
     */
    public function testGetProvidersStaticCall(): void
    {
        $provider = 'Ireland';
        $providers = Yasumi::getProviders();
        $initial_providers = $providers;

        $this->assertNotEmpty($providers);
        $this->assertIsArray($providers);
        $this->assertContains($provider, $providers);

        $providers = Yasumi::getProviders();
        $this->assertNotEmpty($providers);
        $this->assertIsArray($providers);
        $this->assertContains($provider, $providers);
        $this->assertEquals($initial_providers, $providers);
    }

    /**
     * Tests that the isHoliday function returns a boolean true for a date that is defined as a holiday.
     *
     * Note that this function does *NOT* determine whether a date is a working or non-working day. It
     * only asserts that it is a date calculated by the Holiday Provider.
     *
     * @throws Exception
     * @throws ReflectionException
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIsHoliday(): void
    {
        $year = 2110;
        $provider = 'Spain';
        $date = $year . '-08-15';

        // Assertion using a DateTime instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new DateTime($date));
        $this->assertIsBool($isHoliday);
        $this->assertTrue($isHoliday);

        // Assertion using a DateTimeImmutable instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new DateTimeImmutable($date));
        $this->assertIsBool($isHoliday);
        $this->assertTrue($isHoliday);

        unset($isHoliday);
    }

    /**
     * Tests that the isHoliday function returns a boolean false for a date that is not defined as a holiday.
     *
     * Note that this function does *NOT* determine whether a date is a working or non-working day. It
     * only asserts that it is a date calculated by the Holiday Provider.
     *
     * @throws Exception
     * @throws ReflectionException
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIsNotHoliday(): void
    {
        $year = 5220;
        $provider = 'Japan';
        $date = $year . '-06-10';

        // Assertion using a DateTime instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new DateTime($date));
        $this->assertIsBool($isHoliday);
        $this->assertFalse($isHoliday);

        // Assertion using a DateTimeImmutable instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new DateTimeImmutable($date));
        $this->assertIsBool($isHoliday);
        $this->assertFalse($isHoliday);

        unset($isHoliday);
    }

    /**
     * Tests that the isHoliday function throws a TypeError when the given argument is not an instance that
     * implements the DateTimeInterface (e.g. DateTime or DateTimeImmutable)
     *
     * @throws ReflectionException
     */
    public function testIsHolidayException(): void
    {
        $this->expectException(TypeError::class);

        /** @noinspection PhpParamsInspection */
        Yasumi::create('Spain', Factory::create()->numberBetween(
            self::YEAR_LOWER_BOUND,
            self::YEAR_UPPER_BOUND
        ))->isHoliday(new stdClass());
    }

    /**
     * Tests that the isWorkingDay function returns a boolean true for a date that is defined as a holiday or falls in
     * the weekend.
     *
     * @TODO Add additional unit tests for those holiday providers that differ from the global definition
     * @throws Exception
     * @throws ReflectionException
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIsWorkingDay(): void
    {
        $year = 2020;
        $provider = 'Netherlands';
        $date = $year . '-06-02';

        // Assertion using a DateTime instance
        $isWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new DateTime($date));
        $this->assertIsBool($isWorkingDay);
        $this->assertTrue($isWorkingDay);

        // Assertion using a DateTimeImmutable instance
        $isWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new DateTimeImmutable($date));
        $this->assertIsBool($isWorkingDay);
        $this->assertTrue($isWorkingDay);

        unset($isWorkingDay);
    }

    /**
     * Tests that the isWorkingDay function returns a boolean true for a date that is defined as a holiday or falls in
     * the weekend.
     *
     * @TODO Add additional unit tests for those holiday providers that differ from the global definition
     * @throws Exception
     * @throws ReflectionException
     * @throws Exception
     * @throws ReflectionException
     */
    public function testIsNotWorkingDay(): void
    {
        $year = 2016;
        $provider = 'Japan';
        $date = $year . '-01-11';

        // Assertion using a DateTime instance
        $isNotWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new DateTime($date));
        $this->assertIsBool($isNotWorkingDay);
        $this->assertFalse($isNotWorkingDay);

        // Assertion using a DateTimeImmutable instance
        $isNotWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new DateTimeImmutable($date));
        $this->assertIsBool($isNotWorkingDay);
        $this->assertFalse($isNotWorkingDay);

        unset($isNotWorkingDay);
    }

    /**
     * Tests that the isWorkingDay function throws a TypeError when the given argument is not an instance
     * that implements the DateTimeInterface (e.g. DateTime or DateTimeImmutable)
     *
     * @TODO Add additional unit tests for those holiday providers that differ from the global definition
     * @throws ReflectionException
     */
    public function testIsWorkingDayException(): void
    {
        $this->expectException(TypeError::class);

        /** @noinspection PhpParamsInspection */
        Yasumi::create('SouthAfrica', Factory::create()->numberBetween(
            self::YEAR_LOWER_BOUND,
            self::YEAR_UPPER_BOUND
        ))->isWorkingDay(new stdClass());
    }

    /**
     * Tests that holidays successfully can be removed from the list of holidays of a provider
     *
     * @throws ReflectionException
     */
    public function testRemoveHoliday(): void
    {
        $provider = Yasumi::create('Ireland', 2018);
        $holidays = $provider->getHolidays();

        // Assert initial list of holidays
        $this->assertCount(13, $holidays);
        $this->assertArrayHasKey('newYearsDay', $holidays);
        $this->assertArrayHasKey('stPatricksDay', $holidays);
        $this->assertArrayHasKey('substituteHoliday:stPatricksDay', $holidays);
        $this->assertArrayHasKey('goodFriday', $holidays);
        $this->assertArrayHasKey('easter', $holidays);
        $this->assertArrayHasKey('easterMonday', $holidays);
        $this->assertArrayHasKey('mayDay', $holidays);
        $this->assertArrayHasKey('pentecost', $holidays);
        $this->assertArrayHasKey('juneHoliday', $holidays);
        $this->assertArrayHasKey('augustHoliday', $holidays);
        $this->assertArrayHasKey('octoberHoliday', $holidays);
        $this->assertArrayHasKey('christmasDay', $holidays);
        $this->assertArrayHasKey('stStephensDay', $holidays);

        $provider->removeHoliday('juneHoliday');
        $provider->removeHoliday('augustHoliday');
        $provider->removeHoliday('octoberHoliday');

        $holidaysAfterRemoval = $provider->getHolidays();

        // Assert list of holidays after removal of some holidays
        $this->assertCount(10, $holidaysAfterRemoval);
        $this->assertArrayHasKey('newYearsDay', $holidaysAfterRemoval);
        $this->assertArrayHasKey('stPatricksDay', $holidaysAfterRemoval);
        $this->assertArrayHasKey('substituteHoliday:stPatricksDay', $holidaysAfterRemoval);
        $this->assertArrayHasKey('goodFriday', $holidaysAfterRemoval);
        $this->assertArrayHasKey('easter', $holidaysAfterRemoval);
        $this->assertArrayHasKey('easterMonday', $holidaysAfterRemoval);
        $this->assertArrayHasKey('mayDay', $holidaysAfterRemoval);
        $this->assertArrayHasKey('pentecost', $holidaysAfterRemoval);
        $this->assertArrayHasKey('christmasDay', $holidaysAfterRemoval);
        $this->assertArrayHasKey('stStephensDay', $holidaysAfterRemoval);
        $this->assertArrayNotHasKey('juneHoliday', $holidaysAfterRemoval);
        $this->assertArrayNotHasKey('augustHoliday', $holidaysAfterRemoval);
        $this->assertArrayNotHasKey('octoberHoliday', $holidaysAfterRemoval);
    }

    /**
     * Tests that a holiday provider instance can be created by using the ISO3166-2
     * country/region code. (Using the Yasumi::createByISO3166_2 method)
     *
     * @throws ReflectionException
     */
    public function testCreateByISO3166_2(): void
    {
        $year = Factory::create()->numberBetween(
            self::YEAR_LOWER_BOUND,
            self::YEAR_UPPER_BOUND
        );

        $provider = Yasumi::createByISO3166_2(
            'JP',
            $year
        );

        $this->assertEquals($year, $provider->getYear());
    }

    /**
     * Tests that a ProviderNotFoundException is thrown when providing a invalid
     * ISO3166-2 code when using the Yasumi::createByISO3166_2 method.
     *
     * @throws ReflectionException
     */
    public function testCreateByISO3166_2WithInvalidCode(): void
    {
        $this->expectException(ProviderNotFoundException::class);

        Yasumi::createByISO3166_2('XX', 2019);
    }

    /**
     * Tests that a holiday can be added to a provider. In addition, it
     * tests that the same holiday instance isn't added twice.
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testAddExistingHoliday(): void
    {
        $provider = Yasumi::createByISO3166_2('NL', 2019);
        $holidayName = 'testHoliday';

        $holiday = new Holiday($holidayName, [], new DateTime());
        $originalHolidays = $provider->getHolidayNames();

        // Add a new holiday
        $provider->addHoliday($holiday);
        $newHolidays = $provider->getHolidayNames();
        $this->assertContains($holidayName, $provider->getHolidayNames());
        $this->assertNotSameSize($originalHolidays, $newHolidays);
        $this->assertNotEquals($newHolidays, $originalHolidays);

        // Add same holiday again
        $provider->addHoliday($holiday);
        $this->assertContains($holidayName, $provider->getHolidayNames());
        $this->assertSameSize($newHolidays, $provider->getHolidayNames());
        $this->assertNotSameSize($originalHolidays, $provider->getHolidayNames());
        $this->assertEquals($newHolidays, $provider->getHolidayNames());
        $this->assertNotEquals($originalHolidays, $provider->getHolidayNames());
    }
}
