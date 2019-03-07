<?php
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

use InvalidArgumentException;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Yasumi\Translations;

/**
 * Class TranslationsTest.
 *
 * Contains tests for testing the Translations class
 */
class TranslationsTest extends TestCase
{
    public const LOCALES = [
        'en_US',
        'nl_NL',
        'pl_PL',
    ];

    /**
     * Tests adding single translation.
     */
    public function testAddTranslation(): void
    {
        $translations = new Translations(self::LOCALES);

        $locale      = 'en_US';
        $shortName   = 'newYearsDay';
        $translation = 'New Year\'s Day';

        $this->assertNull($translations->getTranslation($shortName, $locale));
        $this->assertEmpty($translations->getTranslations($shortName));

        $translations->addTranslation($shortName, $locale, $translation);

        $this->assertNotNull($translations->getTranslations($shortName));
        $this->assertNotEmpty($translations->getTranslations($shortName));
        $this->assertEquals([$locale => $translation], $translations->getTranslations($shortName));

        $this->assertNotNull($translations->getTranslation($shortName, $locale));
        $this->assertIsString($translations->getTranslation($shortName, $locale));
        $this->assertEquals($translation, $translations->getTranslation($shortName, $locale));
    }

    /**
     * Tests adding multiple translations.
     */
    public function testAddMultipleTranslations(): void
    {
        $translations = new Translations(self::LOCALES);

        $firstLocale      = 'en_US';
        $firstShortName   = 'newYearsDay';
        $firstTranslation = 'New Year\'s Day';

        $translations->addTranslation($firstShortName, $firstLocale, $firstTranslation);

        $this->assertNotNull($translations->getTranslations($firstShortName));
        $this->assertNotEmpty($translations->getTranslations($firstShortName));
        $this->assertEquals([$firstLocale => $firstTranslation], $translations->getTranslations($firstShortName));

        $this->assertNotNull($translations->getTranslation($firstShortName, $firstLocale));
        $this->assertIsString($translations->getTranslation($firstShortName, $firstLocale));
        $this->assertEquals($firstTranslation, $translations->getTranslation($firstShortName, $firstLocale));

        $secondLocale      = 'nl_NL';
        $secondShortName   = 'easter';
        $secondTranslation = 'Eerste paasdag';

        $translations->addTranslation($secondShortName, $secondLocale, $secondTranslation);

        $this->assertNotNull($translations->getTranslations($secondShortName));
        $this->assertNotEmpty($translations->getTranslations($secondShortName));
        $this->assertEquals([$secondLocale => $secondTranslation], $translations->getTranslations($secondShortName));

        $this->assertNotNull($translations->getTranslation($secondShortName, $secondLocale));
        $this->assertIsString($translations->getTranslation($secondShortName, $secondLocale));
        $this->assertEquals($secondTranslation, $translations->getTranslation($secondShortName, $secondLocale));

        $thirdLocale      = 'en_US';
        $thirdShortName   = 'easter';
        $thirdTranslation = 'Easter Sunday';

        $translations->addTranslation($thirdShortName, $thirdLocale, $thirdTranslation);

        $this->assertNotNull($translations->getTranslations($thirdShortName));
        $this->assertNotEmpty($translations->getTranslations($thirdShortName));
        $this->assertEquals(
            [$thirdLocale => $thirdTranslation, $secondLocale => $secondTranslation],
            $translations->getTranslations($thirdShortName)
        );

        $this->assertNotNull($translations->getTranslation($thirdShortName, $thirdLocale));
        $this->assertIsString($translations->getTranslation($thirdShortName, $thirdLocale));
        $this->assertEquals($thirdTranslation, $translations->getTranslation($thirdShortName, $thirdLocale));
    }

    /**
     * Tests that an UnknownLocaleException is thrown when adding translation for unknown locale.
     *
     * @expectedException \Yasumi\Exception\UnknownLocaleException
     */
    public function testAddTranslationUnknownLocaleException(): void
    {
        $translations = new Translations(self::LOCALES);

        $unknownLocale = 'en_XY';
        $shortName     = 'newYearsDay';
        $translation   = 'New Year\'s Day';

        $translations->addTranslation($shortName, $unknownLocale, $translation);
    }

    /**
     * Tests that no translation is returned for an unknown holiday.
     */
    public function testNoTranslationForUnknownHoliday(): void
    {
        $translations = new Translations(self::LOCALES);

        $locale      = 'en_US';
        $shortName   = 'newYearsDay';
        $translation = 'New Year\'s Day';

        $unknownShortName = 'unknownHoliday';

        $translations->addTranslation($shortName, $locale, $translation);

        $this->assertNull($translations->getTranslation($unknownShortName, $locale));
        $this->assertEmpty($translations->getTranslations($unknownShortName));
    }

    /**
     * Tests that no translation is returned for not translated locale.
     */
    public function testNoTranslationForNotTranslatedLocale(): void
    {
        $translations = new Translations(self::LOCALES);

        $locale      = 'en_US';
        $shortName   = 'newYearsDay';
        $translation = 'New Year\'s Day';

        $unknownLocale = 'pl_PL';

        $translations->addTranslation($shortName, $locale, $translation);

        $this->assertNull($translations->getTranslation($shortName, $unknownLocale));
    }

    /**
     * Tests loading one translation file from directory.
     */
    public function testLoadingTranslationsFromDirectory(): void
    {
        $shortName    = 'newYearsDay';
        $fileContents = <<<'FILE'
<?php
return [
    'en_US' => 'New Year\'s Day',
    'nl_NL' => 'Nieuwjaar',
    'pl_PL' => 'Nowy Rok',
];
FILE;

        vfsStream::setup('root', null, ['lang' => [$shortName . '.php' => $fileContents]]);

        $translations = new Translations(self::LOCALES);
        $translations->loadTranslations(vfsStream::url('root/lang'));

        $locale      = 'en_US';
        $translation = 'New Year\'s Day';

        $this->assertNotNull($translations->getTranslations($shortName));
        $this->assertNotEmpty($translations->getTranslations($shortName));
        $this->assertIsString($translations->getTranslation($shortName, $locale));
        $this->assertEquals($translation, $translations->getTranslation($shortName, $locale));
    }

    /**
     * Tests that translation is not loaded from file with invalid extension.
     */
    public function testNotLoadingTranslationsFromFileWithInvalidExtension(): void
    {
        $shortName    = 'newYearsDay';
        $fileContents = <<<'FILE'
<?php
return [
    'en_US' => 'New Year\'s Day',
    'nl_NL' => 'Nieuwjaar',
    'pl_PL' => 'Nowy Rok',
];
FILE;

        vfsStream::setup('root', null, ['lang' => [$shortName . '.translation' => $fileContents]]);

        $translations = new Translations(self::LOCALES);
        $translations->loadTranslations(vfsStream::url('root/lang'));

        $this->assertNotNull($translations->getTranslations($shortName));
        $this->assertEmpty($translations->getTranslations($shortName));
    }

    /**
     * Tests that an UnknownLocaleException is thrown when loading translation with unknown locale(s).
     *
     * @expectedException \Yasumi\Exception\UnknownLocaleException
     */
    public function testLoadingTranslationsFromDirectoryWithUnknownLocaleException(): void
    {
        $shortName    = 'newYearsDay';
        $fileContents = <<<'FILE'
<?php
return [
    'en_XY' => 'New Year\'s Day',
    'nl_NL' => 'Nieuwjaar',
];
FILE;

        vfsStream::setup('root', null, ['lang' => [$shortName . '.php' => $fileContents]]);

        $translations = new Translations(self::LOCALES);
        $translations->loadTranslations(vfsStream::url('root/lang'));
    }

    /**
     * Tests that an InvalidArgumentException is thrown when loading translation from inexistent directory.
     *
     * @expectedException InvalidArgumentException
     */
    public function testLoadingTranslationsFromInexistentDirectory(): void
    {
        vfsStream::setup();

        $translations = new Translations(self::LOCALES);
        $translations->loadTranslations(vfsStream::url('root/lang'));
    }

    /**
     * Tests loading more than one translation file from directory.
     */
    public function testLoadingMultipleTranslationsFromDirectory(): void
    {
        $firstShortName    = 'newYearsDay';
        $firstFileContents = <<<'FILE'
<?php
return [
    'en_US' => 'New Year\'s Day',
    'nl_NL' => 'Nieuwjaar',
    'pl_PL' => 'Nowy Rok',
];
FILE;

        $secondShortName    = 'easter';
        $secondFileContents = <<<'FILE'
<?php
return [
    'en_US' => 'Easter Sunday',
    'nl_NL' => 'Eerste Paasdag',
];
FILE;

        vfsStream::setup('root', null, [
            'lang' => [
                $firstShortName . '.php'  => $firstFileContents,
                $secondShortName . '.php' => $secondFileContents
            ]
        ]);

        $translations = new Translations(self::LOCALES);

        $translations->loadTranslations(vfsStream::url('root/lang'));

        $locale      = 'en_US';
        $translation = 'New Year\'s Day';

        $this->assertNotNull($translations->getTranslations($firstShortName));
        $this->assertNotEmpty($translations->getTranslations($firstShortName));
        $this->assertIsString($translations->getTranslation($firstShortName, $locale));
        $this->assertEquals($translation, $translations->getTranslation($firstShortName, $locale));

        $locale      = 'nl_NL';
        $translation = 'Eerste Paasdag';

        $this->assertNotNull($translations->getTranslations($secondShortName));
        $this->assertNotEmpty($translations->getTranslations($secondShortName));
        $this->assertIsString($translations->getTranslation($secondShortName, $locale));
        $this->assertEquals($translation, $translations->getTranslation($secondShortName, $locale));
    }
}
