<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Base;

use Faker\Factory;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class YasumiTest.
 *
 * Contains tests for testing the Holiday class
 */
class YasumiTest extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * The lower year limit supported by Yasumi
     */
    const YEAR_LOWER_BOUND = 1000;

    /**
     * The upper year limit supported by Yasumi
     */
    const YEAR_UPPER_BOUND = 9999;

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid year is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testCreateWithInvalidYear()
    {
        Yasumi::create('Japan', 10100);
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid holiday provider is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testCreateWithInvalidProvider()
    {
        Yasumi::create('Mars');
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case we try to load a Trait as provider.
     *
     * @expectedException InvalidArgumentException
     */
    public function testCreateWithInvalidProviderBecauseItsATrait()
    {
        Yasumi::create('CommonHolidays');
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case we try to load the AbstractProvider as provider.
     *
     * @expectedException InvalidArgumentException
     */
    public function testCreateWithAbstractClassProvider()
    {
        Yasumi::create('AbstractProvider');
    }

    /**
     * Tests that Yasumi allows external classes that extend the ProviderInterface.
     */
    public function testCreateWithAbstractExtension()
    {
        $class    = YasumiExternalProvider::class;
        $instance = Yasumi::create(
            $class,
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND)
        );
        $this->assertInstanceOf($class, $instance);
    }

    /**
     * Tests that an Yasumi\Exception\UnknownLocaleException is thrown in case an invalid locale is given.
     *
     * @expectedException \Yasumi\Exception\UnknownLocaleException
     */
    public function testCreateWithInvalidLocale()
    {
        Yasumi::create(
            'Japan',
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND),
            'wx_YZ'
        );
    }

    /**
     * Tests that the getIterator function returns an ArrayIterator object
     */
    public function testGetIterator()
    {
        $holidays = Yasumi::create(
            'Japan',
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND)
        );

        $this->assertInstanceOf(\ArrayIterator::class, $holidays->getIterator());
    }

    /**
     * Tests that the count function returns an integer and a correct count for the test holiday provider
     */
    public function testCount()
    {
        // There are 16 holidays in Japan in the year 2015, with 1 substituted holiday.
        $holidays = Yasumi::create('Japan', 2015);

        $this->assertInternalType('int', $holidays->count());
        $this->assertEquals(16, $holidays->count());
        $this->assertNotEquals(17, $holidays->count());
    }

    /**
     * Tests that the getType function returns a string for the test holiday provider
     */
    public function testGetType()
    {
        $holidays = Yasumi::create('Japan', Factory::create()->numberBetween(1949, self::YEAR_UPPER_BOUND));
        $holiday  = $holidays->getHoliday('newYearsDay');

        $this->assertInternalType('string', $holiday->getType());
    }

    /**
     * Tests that the getYear function returns an integer for the test holiday provider
     */
    public function testGetYear()
    {
        $year     = Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND);
        $holidays = Yasumi::create('Netherlands', $year);

        $this->assertInternalType('integer', $holidays->getYear());
        $this->assertEquals($year, $holidays->getYear());
    }

    /**
     * Tests that the next function returns the next upcoming date (i.e. next year) for the given holiday
     */
    public function testNext()
    {
        $country = 'Japan';
        $name    = 'childrensDay';
        $year    = Factory::create()->numberBetween(1949, self::YEAR_UPPER_BOUND);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday(
            $country,
            $name,
            (($year < self::YEAR_UPPER_BOUND) ? $year + 1 : self::YEAR_UPPER_BOUND),
            $holidays->next($name)
        );
    }

    /**
     * Tests the next function that an InvalidArgumentException is thrown in case a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testNextWithBlankName()
    {
        $holidays = Yasumi::create(
            'Netherlands',
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND)
        );
        $holidays->next(null);
    }

    /**
     * Tests the previous function returns the previous date (i.e. previous year) for the given holiday
     */
    public function testPrevious()
    {
        $country          = 'Netherlands';
        $name             = 'liberationDay';
        $year_lower_limit = 1949;
        $year             = Factory::create()->numberBetween($year_lower_limit, self::YEAR_UPPER_BOUND);

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
     * @expectedException InvalidArgumentException
     */
    public function testPreviousWithBlankName()
    {
        $holidays = Yasumi::create(
            'Netherlands',
            Factory::create()->numberBetween(self::YEAR_LOWER_BOUND, self::YEAR_UPPER_BOUND)
        );
        $holidays->previous(null);
    }

    /**
     * Tests that the getHolidayNames function returns an array and a correct count for the test holiday provider
     */
    public function testGetHolidayNames()
    {
        $holidays     = Yasumi::create('Japan', 2015);
        $holidayNames = $holidays->getHolidayNames();

        $this->assertInternalType('array', $holidayNames);
        $this->assertCount(17, $holidayNames);
        $this->assertContains('newYearsDay', $holidayNames);
    }

    /**
     * Tests that the WhenIs function returns a string representation of the date the given holiday occurs.
     */
    public function testWhenIs()
    {
        $holidays = Yasumi::create('Japan', 2010);

        $when = $holidays->whenIs('autumnalEquinoxDay');

        $this->assertInternalType('string', $when);
        $this->assertEquals('2010-09-23', $when);
    }

    /**
     * Tests that the WhenIs function throws an InvalidArgumentException when a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testWhenIsWithBlankName()
    {
        $holidays = Yasumi::create('Japan', 2010);
        $holidays->whenIs(null);
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case a blank name is given for the getHoliday function.
     *
     * @expectedException InvalidArgumentException
     */
    public function testGetHolidayWithBlankName()
    {
        $holidays = Yasumi::create('Netherlands', 1999);
        $holidays->getHoliday(null);
    }

    /**
     * Tests that the whatWeekDayIs function returns an integer representation of the day of the week the given holiday
     * is occurring.
     */
    public function testWhatWeekDayIs()
    {
        $holidays = Yasumi::create('Netherlands', 2110);
        $weekDay  = $holidays->whatWeekDayIs('stMartinsDay');

        $this->assertInternalType('int', $weekDay);
        $this->assertEquals(2, $weekDay);
    }

    /**
     * Tests that the whatWeekDayIs function throws an InvalidArgumentException when a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testWhatWeekDayIsWithBlankName()
    {
        $holidays = Yasumi::create('Netherlands', 2388);
        $holidays->whatWeekDayIs(null);
    }

    /**
     * Tests that the getProviders function returns an array containing all available holiday providers.
     */
    public function testGetProviders()
    {
        $providers = Yasumi::getProviders();

        $this->assertNotEmpty($providers);
        $this->assertInternalType('array', $providers);
        $this->assertContains('Netherlands', $providers);
        $this->assertEquals('USA', $providers['US']);
        $this->assertNotContains('AbstractProvider', $providers);
    }

    /**
     * Tests that the getProviders function (static call) returns the same data when called again.
     */
    public function testGetProvidersStaticCall()
    {
        $provider          = 'Ireland';
        $providers         = Yasumi::getProviders();
        $initial_providers = $providers;

        $this->assertNotEmpty($providers);
        $this->assertInternalType('array', $providers);
        $this->assertContains($provider, $providers);

        $providers = Yasumi::getProviders();
        $this->assertNotEmpty($providers);
        $this->assertInternalType('array', $providers);
        $this->assertContains($provider, $providers);
        $this->assertEquals($initial_providers, $providers);
    }

    /**
     * Tests that the isHoliday function returns a boolean true for a date that is defined as a holiday.
     */
    public function testIsHoliday()
    {
        $year     = 2110;
        $provider = 'Spain';
        $date     = $year . '-08-15';

        // Assertion using a DateTime instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new \DateTime($date));
        $this->assertInternalType('bool', $isHoliday);
        $this->assertTrue($isHoliday);

        // Assertion using a DateTimeImmutable instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new \DateTimeImmutable($date));
        $this->assertInternalType('bool', $isHoliday);
        $this->assertTrue($isHoliday);

        unset($isHoliday);
    }

    /**
     * Tests that the isHoliday function returns a boolean false for a date that is not defined as a holiday.
     */
    public function testIsNotHoliday()
    {
        $year     = 5220;
        $provider = 'Japan';
        $date     = $year . '-06-10';

        // Assertion using a DateTime instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new \DateTime($date));
        $this->assertInternalType('bool', $isHoliday);
        $this->assertFalse($isHoliday);

        // Assertion using a DateTimeImmutable instance
        $isHoliday = Yasumi::create($provider, $year)->isHoliday(new \DateTimeImmutable($date));
        $this->assertInternalType('bool', $isHoliday);
        $this->assertFalse($isHoliday);

        unset($isHoliday);
    }

    /**
     * Tests that the isHoliday function throws a TypeError when the given argument is not an instance that
     * implements the DateTimeInterface (e.g. DateTime or DateTimeImmutable)
     */
    public function testIsHolidayException()
    {
        $this->expectException(\TypeError::class);

        Yasumi::create('Spain', Factory::create()->numberBetween(
            self::YEAR_LOWER_BOUND,
            self::YEAR_UPPER_BOUND
        ))->isHoliday(new \stdClass());
    }

    /**
     * Tests that the isWorkingDay function returns a boolean true for a date that is defined as a holiday or falls in
     * the weekend.
     *
     * @TODO Add additional unit tests for those holiday providers that differ from the global definition
     */
    public function testIsWorkingDay()
    {
        $year     = 2020;
        $provider = 'Netherlands';
        $date     = $year . '-06-02';

        // Assertion using a DateTime instance
        $isWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new \DateTime($date));
        $this->assertInternalType('bool', $isWorkingDay);
        $this->assertTrue($isWorkingDay);

        // Assertion using a DateTimeImmutable instance
        $isWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new \DateTimeImmutable($date));
        $this->assertInternalType('bool', $isWorkingDay);
        $this->assertTrue($isWorkingDay);

        unset($isWorkingDay);
    }

    /**
     * Tests that the isWorkingDay function returns a boolean true for a date that is defined as a holiday or falls in
     * the weekend.
     *
     * @TODO Add additional unit tests for those holiday providers that differ from the global definition
     */
    public function testIsNotWorkingDay()
    {
        $year     = 2016;
        $provider = 'Japan';
        $date     = $year . '-01-11';

        // Assertion using a DateTime instance
        $isNotWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new \DateTime($date));
        $this->assertInternalType('bool', $isNotWorkingDay);
        $this->assertFalse($isNotWorkingDay);

        // Assertion using a DateTimeImmutable instance
        $isNotWorkingDay = Yasumi::create($provider, $year)->isWorkingDay(new \DateTimeImmutable($date));
        $this->assertInternalType('bool', $isNotWorkingDay);
        $this->assertFalse($isNotWorkingDay);

        unset($isNotWorkingDay);
    }

    /**
     * Tests that the isWorkingDay function throws a TypeError when the given argument is not an instance
     * that implements the DateTimeInterface (e.g. DateTime or DateTimeImmutable)
     *
     * @TODO Add additional unit tests for those holiday providers that differ from the global definition
     */
    public function testIsWorkingDayException()
    {
        $this->expectException(\TypeError::class);

        Yasumi::create('SouthAfrica', Factory::create()->numberBetween(
            self::YEAR_LOWER_BOUND,
            self::YEAR_UPPER_BOUND
        ))->isWorkingDay(new \stdClass());
    }

    /**
     * Tests that holidays successfully can be removed from the list of holidays of a provider
     *
     * @throws \ReflectionException
     */
    public function testRemoveHoliday()
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
}
