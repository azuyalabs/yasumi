<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Yasumi\Holiday;
use Yasumi\Tests\YasumiBase;

/**
 * Class HolidayTest.
 *
 * Contains tests for testing the Holiday class
 */
class HolidayTest extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Tests that an InvalidArgumentException is thrown in case an blank short name is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testHolidayBlankNameInvalidArgumentException()
    {
        new Holiday('', [], '2015-01-01');
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid type for date is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testHolidayInvalidDateTypeInvalidArgumentException()
    {
        new Holiday('testHoliday', [], '2015-01-01');
    }

    /**
     * Tests that an Yasumi\Exception\UnknownLocaleException is thrown in case an invalid locale is given.
     *
     * @expectedException Yasumi\Exception\UnknownLocaleException
     */
    public function testCreateHolidayUnknownLocaleException()
    {
        new Holiday('testHoliday', [], new DateTime(), 'wx-YZ');
    }

    /**
     * Tests that a Yasumi holiday instance can be serialized to a JSON object.
     */
    public function testHolidayIsJsonSerializable()
    {
        $holiday  = new Holiday('testHoliday', [], new DateTime(), 'en_US');
        $json     = json_encode($holiday);
        $instance = json_decode($json, true);

        $this->assertInternalType('array', $instance);
        $this->assertNotSame(null, $instance);
        $this->assertArrayHasKey('shortName', $instance);
    }

    /**
     * Tests the getName function of the Holiday object with no translations for the name given.
     */
    public function testHolidayGetNameWithNoTranslations()
    {
        $name    = 'testHoliday';
        $holiday = new Holiday($name, [], new DateTime(), 'en_US');

        $this->assertInternalType('string', $holiday->getName());
        $this->assertEquals($name, $holiday->getName());
    }

    /**
     * Tests the getName function of the Holiday object with only a default translation for the name given.
     */
    public function testHolidayGetNameWithOnlyDefaultTranslation()
    {
        $name        = 'testHoliday';
        $translation = 'My Holiday';
        $locale      = 'en_US';
        $holiday     = new Holiday($name, [$locale => $translation], new DateTime(), $locale);

        $this->assertInternalType('string', $holiday->getName());
        $this->assertEquals($translation, $holiday->getName());
    }

    /**
     * Tests the getName function of the Holiday object with only a default translation for the name given.
     */
    public function testHolidayGetNameWithOneNonDefaultTranslation()
    {
        $name        = 'testHoliday';
        $translation = 'My Holiday';
        $holiday     = new Holiday($name, ['en_US' => $translation], new DateTime(), 'nl_NL');

        $this->assertNotNull($holiday->getName());
        $this->assertInternalType('string', $holiday->getName());
        $this->assertEquals($translation, $holiday->getName());
    }
}
