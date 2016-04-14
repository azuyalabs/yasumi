<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

use Faker\Factory;
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
     * Tests that an Yasumi\Exception\UnknownLocaleException is thrown in case an invalid locale is given.
     *
     * @expectedException \Yasumi\Exception\UnknownLocaleException
     */
    public function testCreateWithInvalidLocale()
    {
        Yasumi::create('Japan', Factory::create()->numberBetween(1000, 9999), 'wx_YZ');
    }

    /**
     * Tests that the getIterator function returns an ArrayIterator object
     */
    public function testGetIterator()
    {
        $holidays = Yasumi::create('Japan', Factory::create()->numberBetween(1000, 9999));

        $this->assertInstanceOf('ArrayIterator', $holidays->getIterator());
    }

    /**
     * Tests that the count function returns an integer and a correct count for the test holiday provider
     */
    public function testCount()
    {
        $holidays = Yasumi::create('Japan', 2015);

        $this->assertInternalType('int', $holidays->count());
        $this->assertEquals(17, $holidays->count());
    }

    /**
     * Tests that the getType function returns a string for the test holiday provider
     */
    public function testGetType()
    {
        $holidays = Yasumi::create('Japan', Factory::create()->numberBetween(1949, 9999));
        $holiday  = $holidays->getHoliday('newYearsDay');

        $this->assertInternalType('string', $holiday->getType());
    }

    /**
     * Tests that the getYear function returns an integer for the test holiday provider
     */
    public function testGetYear()
    {
        $year     = Factory::create()->numberBetween(1000, 9999);
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
        $year    = Factory::create()->numberBetween(1949, 9999);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday($country, $name, $year + 1, $holidays->next($name));
    }

    /**
     * Tests the next function that an InvalidArgumentException is thrown in case a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testNextWithBlankName()
    {
        $holidays = Yasumi::create('Netherlands', Factory::create()->numberBetween(1000, 9999));
        $holidays->next(null);
    }

    /**
     * Tests the previous function returns the previous date (i.e. previous year) for the given holiday
     */
    public function testPrevious()
    {
        $country = 'Netherlands';
        $name    = 'liberationDay';
        $year    = Factory::create()->numberBetween(1949, 9999);

        $holidays = Yasumi::create($country, $year);

        $this->assertHoliday($country, $name, $year - 1, $holidays->previous($name));
    }

    /**
     * Tests the previous function that an InvalidArgumentException is thrown in case a blank name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testPreviousWithBlankName()
    {
        $holidays = Yasumi::create('Netherlands', Factory::create()->numberBetween(1000, 9999));
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
        $this->assertEquals(17, sizeof($holidayNames));
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
    }

    /**
     * Tests that the isHoliday function returns a boolean true for a date that is defined as a holiday.
     */
    public function testIsHoliday()
    {
        $year      = 2110;
        $isHoliday = Yasumi::create('Spain', $year)->isHoliday(new DateTime($year . '-08-15'));

        $this->assertInternalType('bool', $isHoliday);
        $this->assertTrue($isHoliday);

        unset($isHoliday);
    }

    /**
     * Tests that the isHoliday function returns a boolean false for a date that is not defined as a holiday.
     */
    public function testIsNotHoliday()
    {
        $year      = 5220;
        $isHoliday = Yasumi::create('Japan', $year)->isHoliday(new DateTime($year . '-06-10'));

        $this->assertInternalType('bool', $isHoliday);
        $this->assertFalse($isHoliday);

        unset($isHoliday);
    }

    /**
     * Tests that the IsWorkingDay function returns a boolean true for a date that is defined as a holiday or falls in
     * the weekend.
     */
    public function testIsWorkingDay()
    {
        $year         = 2020;
        $isWorkingDay = Yasumi::create('Netherlands', $year)->isWorkingDay(new DateTime($year . '-06-02'));

        $this->assertInternalType('bool', $isWorkingDay);
        $this->assertTrue($isWorkingDay);

        unset($isWorkingDay);
    }

    /**
     * Tests that the IsWorkingDay function returns a boolean true for a date that is defined as a holiday or falls in
     * the weekend.
     */
    public function testIsNotWorkingDay()
    {
        $year            = 2016;
        $isNotWorkingDay = Yasumi::create('Japan', $year)->isWorkingDay(new DateTime($year . '-01-11'));

        $this->assertInternalType('bool', $isNotWorkingDay);
        $this->assertFalse($isNotWorkingDay);

        unset($isWorkingDay);
    }
}
