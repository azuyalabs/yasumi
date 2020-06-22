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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;
use Yasumi\tests\YasumiBase;
use Yasumi\TranslationsInterface;

/**
 * Class SubstituteHolidayTest.
 *
 * Contains tests for testing the SubstituteHoliday class
 */
class SubstituteHolidayTest extends TestCase
{
    use YasumiBase;

    /**
     * Tests that an UnknownLocaleException is thrown in case an invalid locale is given.
     *
     * @throws \Exception
     */
    public function testCreateSubstituteHolidayUnknownLocaleException(): void
    {
        $holiday = new Holiday('testHoliday', [], new DateTime());

        $this->expectException(UnknownLocaleException::class);

        new SubstituteHoliday($holiday, [], new DateTime(), 'wx-YZ');
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case the substitute is on the same date as the substituted.
     * @throws \Exception
     */
    public function testCreateSubstituteHolidaySameDate(): void
    {
        $holiday = new Holiday('testHoliday', [], new DateTime('2019-01-01'));

        $this->expectException(InvalidArgumentException::class);

        new SubstituteHoliday($holiday, [], new DateTime('2019-01-01'));
    }

    /**
     * Tests the constructor.
     *
     * @throws \Exception
     */
    public function testConstructor(): void
    {
        $holiday = new Holiday('testHoliday', [], new DateTime('2019-01-01'), 'en_US', Holiday::TYPE_BANK);
        $substitute = new SubstituteHoliday($holiday, [], new DateTime('2019-01-02'), 'en_US', Holiday::TYPE_SEASON);

        $this->assertSame($holiday, $substitute->getSubstitutedHoliday());
        $this->assertEquals('substituteHoliday:testHoliday', $substitute->getKey());
        $this->assertEquals(Holiday::TYPE_SEASON, $substitute->getType());
        $this->assertEquals(new DateTime('2019-01-02'), $substitute);
    }

    /**
     * Tests that a Yasumi holiday instance can be serialized to a JSON object.
     * @throws \Exception
     */
    public function testSubstituteHolidayIsJsonSerializable(): void
    {
        $holiday = new Holiday('testHoliday', [], new DateTime('2019-01-01'), 'en_US');
        $substitute = new SubstituteHoliday($holiday, [], new DateTime('2019-01-02'), 'en_US');
        $json = \json_encode($substitute);
        $instance = \json_decode($json, true);

        $this->assertIsArray($instance);
        $this->assertNotNull($instance);
        $this->assertArrayHasKey('shortName', $instance);
        $this->assertArrayHasKey('substitutedHoliday', $instance);
    }

    /**
     * Tests that a Yasumi holiday instance can be created using an object that implements the DateTimeInterface (e.g.
     * DateTime or DateTimeImmutable)
     * @throws \Exception
     */
    public function testSubstituteHolidayWithDateTimeInterface(): void
    {
        // Assert with DateTime instance
        $holiday = new Holiday('testHoliday', [], new DateTime('2019-01-01'), 'en_US');
        $substitute = new SubstituteHoliday($holiday, [], new DateTime('2019-01-02'), 'en_US');
        $this->assertNotNull($holiday);
        $this->assertInstanceOf(SubstituteHoliday::class, $substitute);

        // Assert with DateTimeImmutable instance
        $substitute = new SubstituteHoliday($holiday, [], new \DateTimeImmutable(), 'en_US');
        $this->assertNotNull($holiday);
        $this->assertInstanceOf(SubstituteHoliday::class, $substitute);
    }

    /**
     * Tests the getName function of the SubstituteHoliday object with no translations for the name given.
     * @throws \Exception
     */
    public function testSubstituteHolidayGetNameWithNoTranslations(): void
    {
        $name = 'testHoliday';
        $holiday = new Holiday($name, [], new DateTime('2019-01-01'));
        $substitute = new SubstituteHoliday($holiday, [], new DateTime('2019-01-02'), 'en_US');

        $this->assertIsString($substitute->getName());
        $this->assertEquals('substituteHoliday:' . $name, $substitute->getName());
    }

    /**
     * Tests the getName function of the SubstituteHoliday object when it has a custom translation.
     * @throws \Exception
     */
    public function testSubstituteHolidayGetNameWithCustomSubstituteTranslation(): void
    {
        $name = 'testHoliday';
        $translation = 'My Holiday';
        $locale = 'en_US';
        $holiday = new Holiday($name, [$locale => 'foo'], new DateTime('2019-01-01'), $locale);
        $substitute = new SubstituteHoliday($holiday, [$locale => $translation], new DateTime('2019-01-02'), $locale);

        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();
        $translationsStub->expects($this->at(0))->method('getTranslations')->with($this->equalTo('substituteHoliday'))->willReturn([$locale => 'foo']);
        $translationsStub->expects($this->at(1))->method('getTranslations')->with($this->equalTo('substituteHoliday:testHoliday'))->willReturn([$locale => 'foo']);
        $translationsStub->expects($this->at(2))->method('getTranslations')->with($this->equalTo('testHoliday'))->willReturn(['en' => 'foo']);

        $substitute->mergeGlobalTranslations($translationsStub);

        $this->assertIsString($substitute->getName());
        $this->assertEquals($translation, $substitute->getName());
    }

    /**
     * Tests the getName function of the SubstituteHoliday object when substitute holiday pattern uses fallback.
     * @throws \Exception
     */
    public function testSubstituteHolidayGetNameWithPatternFallback(): void
    {
        $name = 'testHoliday';
        $translation = 'My Holiday';
        $locale = 'en_US';
        $holiday = new Holiday($name, [], new DateTime('2019-01-01'), $locale);
        $substitute = new SubstituteHoliday($holiday, [], new DateTime('2019-01-02'), $locale);

        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();
        $translationsStub->expects($this->at(0))->method('getTranslations')->with($this->equalTo('substituteHoliday'))->willReturn(['en' => '{0} obs']);
        $translationsStub->expects($this->at(1))->method('getTranslations')->with($this->equalTo('substituteHoliday:testHoliday'))->willReturn([]);
        $translationsStub->expects($this->at(2))->method('getTranslations')->with($this->equalTo('testHoliday'))->willReturn([$locale => $translation]);

        $substitute->mergeGlobalTranslations($translationsStub);

        $this->assertIsString($substitute->getName());
        $this->assertEquals('My Holiday obs', $substitute->getName());
    }

    /**
     * Tests the getName function of the SubstituteHoliday object when it has a global translation.
     * @throws \Exception
     */
    public function testSubstituteHolidayGetNameWithGlobalSubstituteTranslation(): void
    {
        $name = 'testHoliday';
        $translation = 'My Substitute';
        $locale = 'en_US';
        $holiday = new Holiday($name, [$locale => 'foo'], new DateTime('2019-01-01'), $locale);
        $substitute = new SubstituteHoliday($holiday, [$locale => $translation], new DateTime('2019-01-02'), $locale);

        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();
        $translationsStub->expects($this->at(0))->method('getTranslations')->with($this->equalTo('substituteHoliday'))->willReturn([$locale => '{0} observed']);
        $translationsStub->expects($this->at(1))->method('getTranslations')->with($this->equalTo('substituteHoliday:testHoliday'))->willReturn([$locale => $translation]);
        $translationsStub->expects($this->at(2))->method('getTranslations')->with($this->equalTo('testHoliday'))->willReturn([$locale => 'foo']);

        $substitute->mergeGlobalTranslations($translationsStub);

        $this->assertIsString($substitute->getName());
        $this->assertEquals($translation, $substitute->getName());
    }

    /**
     * Tests the getName function of the SubstituteHoliday object when only the substituted holiday has a translation.
     * @throws \Exception
     */
    public function testSubstituteHolidayGetNameWithSubstitutedTranslation(): void
    {
        $name = 'testHoliday';
        $translation = 'My Holiday';
        $locale = 'en_US';
        $holiday = new Holiday($name, [$locale => $translation], new DateTime('2019-01-01'), $locale);
        $substitute = new SubstituteHoliday($holiday, [], new DateTime('2019-01-02'), $locale);

        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();
        $translationsStub->expects($this->at(0))->method('getTranslations')->with($this->equalTo('substituteHoliday'))->willReturn([$locale => '{0} observed']);
        $translationsStub->expects($this->at(1))->method('getTranslations')->with($this->equalTo('substituteHoliday:testHoliday'))->willReturn([]);
        $translationsStub->expects($this->at(2))->method('getTranslations')->with($this->equalTo('testHoliday'))->willReturn([$locale => $translation]);

        $substitute->mergeGlobalTranslations($translationsStub);

        $this->assertIsString($substitute->getName());
        $this->assertEquals('My Holiday observed', $substitute->getName());
    }
}
