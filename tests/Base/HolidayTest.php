<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiBase;
use Yasumi\TranslationsInterface;
use Yasumi\Yasumi;

/**
 * Class HolidayTest.
 *
 * Contains tests for testing the Holiday class
 */
class HolidayTest extends TestCase
{
    use YasumiBase;

    /**
     * Tests that an InvalidArgumentException is thrown in case an blank short name is given.
     *
     * @throws Exception
     */
    public function testHolidayBlankNameInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Holiday('', [], new DateTime());
    }

    /**
     * Tests that an Yasumi\Exception\UnknownLocaleException is thrown in case an invalid locale is given.
     *
     * @throws Exception
     */
    public function testCreateHolidayUnknownLocaleException(): void
    {
        $this->expectException(UnknownLocaleException::class);

        new Holiday('testHoliday', [], new DateTime(), 'wx-YZ');
    }

    /**
     * Tests that a Yasumi holiday instance can be serialized to a JSON object.
     * @throws Exception
     */
    public function testHolidayIsJsonSerializable(): void
    {
        $holiday = new Holiday('testHoliday', [], new DateTime(), 'en_US');
        $json = \json_encode($holiday);
        $instance = \json_decode($json, true);

        $this->assertIsArray($instance);
        $this->assertNotNull($instance);
        $this->assertArrayHasKey('shortName', $instance);
    }

    /**
     * Tests that a Yasumi holiday instance can be created using an object that implements the DateTimeInterface (e.g.
     * DateTime or DateTimeImmutable)
     * @throws Exception
     */
    public function testHolidayWithDateTimeInterface(): void
    {
        // Assert with DateTime instance
        $holiday = new Holiday('testHoliday', [], new DateTime(), 'en_US');
        $this->assertNotNull($holiday);
        $this->assertInstanceOf(Holiday::class, $holiday);

        // Assert with DateTimeImmutable instance
        $holiday = new Holiday('testHoliday', [], new DateTimeImmutable(), 'en_US');
        $this->assertNotNull($holiday);
        $this->assertInstanceOf(Holiday::class, $holiday);
    }

    /**
     * Tests the getName function of the Holiday object with no translations for the name given.
     * @throws Exception
     */
    public function testHolidayGetNameWithNoTranslations(): void
    {
        $name    = 'testHoliday';
        $locale  = 'en_US';
        $holiday = new Holiday($name, [], new DateTime(), $locale);

        $this->assertEquals($name, $holiday->getName());
        $this->assertEquals($name, $holiday->getName($locale));
        $this->assertEquals($name, $holiday->getName('ja_JP'));
    }

    /**
     * Tests the getName function of the Holiday object with only a default translation for the name given.
     * @throws Exception
     */
    public function testHolidayGetNameWithOnlyDefaultTranslation(): void
    {
        $name = 'testHoliday';
        $translation = 'My Holiday';
        $locale      = 'it_IT';
        $holiday     = new Holiday($name, [$locale => $translation], new DateTime(), $locale);

        Yasumi::setDefaultLocale($locale);

        $this->assertEquals($translation, $holiday->getName());
        $this->assertEquals($translation, $holiday->getName($locale));
        $this->assertEquals($translation, $holiday->getName('ja_JP'));
    }

    /**
     * Tests the getName function of the Holiday object with only a default translation for the name given.
     *
     * @throws Exception
     */
    public function testHolidayGetNameWithOneNonDefaultTranslation(): void
    {
        $name = 'testHoliday';
        $translation = 'My Holiday';
        $locale      = 'en_US';
        $holiday     = new Holiday($name, [$locale => $translation], new DateTime(), 'nl_NL');

        Yasumi::setDefaultLocale($locale);

        $this->assertEquals($translation, $holiday->getName());
        $this->assertEquals($translation, $holiday->getName($locale));
        $this->assertEquals($translation, $holiday->getName('ja_JP'));
    }

    /**
     * Tests the getName function of the Holiday object with global translations and no custom translation.
     * @throws Exception
     */
    public function testHolidayGetNameWithGlobalTranslations(): void
    {
        /** @var TranslationsInterface|PHPUnit_Framework_MockObject_MockObject $translationsStub */
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year\'s Day',
            'pl_PL' => 'Nowy Rok'
        ];

        $translationsStub->expects($this->once())->method('getTranslations')->with($this->equalTo('newYearsDay'))->willReturn($translations);

        $locale = 'pl_PL';

        $holiday = new Holiday('newYearsDay', [], new DateTime('2015-01-01'), $locale);
        $holiday->mergeGlobalTranslations($translationsStub);

        $this->assertEquals($translations[$locale], $holiday->getName());
        $this->assertEquals($translations['en_US'], $holiday->getName('en_US'));
        $this->assertEquals($translations['en_US'], $holiday->getName('it_IT'));
    }

    /**
     * Tests the getName function of the Holiday object with global translations and a new custom translation.
     * @throws Exception
     */
    public function testHolidayGetNameWithGlobalAndCustomTranslations(): void
    {
        /** @var TranslationsInterface|PHPUnit_Framework_MockObject_MockObject $translationsStub */
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year\'s Day',
            'pl_PL' => 'Nowy Rok'
        ];

        $translationsStub->expects($this->once())->method('getTranslations')->with($this->equalTo('newYearsDay'))->willReturn($translations);

        $customLocale = 'nl_NL';
        $customTranslation = 'Nieuwjaar';

        $holiday = new Holiday(
            'newYearsDay',
            [$customLocale => $customTranslation],
            new DateTime('2015-01-01'),
            $customLocale
        );
        $holiday->mergeGlobalTranslations($translationsStub);

        $this->assertEquals($customTranslation, $holiday->getName());
        $this->assertEquals($customTranslation, $holiday->getName($customLocale));
        $this->assertEquals($translations['pl_PL'], $holiday->getName('pl_PL'));
        $this->assertEquals($translations['en_US'], $holiday->getName('en_US'));
        $this->assertEquals($translations['en_US'], $holiday->getName('it_IT'));
    }

    /**
     * Tests the getName function of the Holiday object with global translations and an overriding custom translation.
     * @throws Exception
     */
    public function testHolidayGetNameWithOverridenGlobalTranslations(): void
    {
        /** @var TranslationsInterface|PHPUnit_Framework_MockObject_MockObject $translationsStub */
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year\'s Day',
            'pl_PL' => 'Nowy Rok'
        ];

        $translationsStub->expects($this->once())->method('getTranslations')->with($this->equalTo('newYearsDay'))->willReturn($translations);

        $customLocale = 'pl_PL';
        $customTranslation = 'Bardzo Nowy Rok';

        $holiday = new Holiday(
            'newYearsDay',
            [$customLocale => $customTranslation],
            new DateTime('2014-01-01'),
            $customLocale
        );
        $holiday->mergeGlobalTranslations($translationsStub);

        $this->assertEquals($customTranslation, $holiday->getName());
        $this->assertEquals($customTranslation, $holiday->getName($customLocale));
        $this->assertEquals($translations['en_US'], $holiday->getName('en_US'));
        $this->assertEquals($translations['en_US'], $holiday->getName('it_IT'));
    }
}
